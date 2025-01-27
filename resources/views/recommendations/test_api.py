from flask import Flask, jsonify, request
import pandas as pd
from surprise import Dataset, Reader, SVD
from surprise.model_selection import train_test_split
from surprise import accuracy
import mysql.connector

app = Flask(__name__)

# Database connection details
db_config = {
    'host': 'localhost',
    'user': 'root',
    'password': '',
    'database': 'cafereserve'
}

def fetch_feedback_and_tags():
    """Fetch feedback and tags data from MySQL."""
    conn = mysql.connector.connect(**db_config)

    # Fetch feedbacks with user and cafe tags
    query = """
        SELECT f.user_id, f.cafe_id, f.rating, u.user_tags, c.cafe_tags
        FROM feedbacks f
        JOIN users u ON f.user_id = u.user_id
        JOIN cafes c ON f.cafe_id = c.cafe_id
    """
    df = pd.read_sql(query, conn)
    conn.close()
    return df

def calculate_tag_similarity(user_tags, cafe_tags):
    """Calculate similarity between user_tags and cafe_tags."""
    user_set = set(user_tags.split(",")) if user_tags else set()
    cafe_set = set(cafe_tags.split(","))
    return len(user_set & cafe_set) / len(user_set | cafe_set) if user_set | cafe_set else 0

def train_model(data):
    """Train a collaborative filtering model using Surprise."""
    reader = Reader(rating_scale=(1, 5))
    dataset = Dataset.load_from_df(data[['user_id', 'cafe_id', 'rating']], reader)

    # Split into train and test sets
    trainset, testset = train_test_split(dataset, test_size=0.25)

    # Train a collaborative filtering model
    model = SVD()
    model.fit(trainset)

    # Evaluate the model
    predictions = model.test(testset)
    accuracy.rmse(predictions)

    return model

def fallback_recommendations(top_n):
    """Provide fallback recommendations when personalized data is unavailable."""
    conn = mysql.connector.connect(**db_config)
    query = """
        SELECT f.cafe_id, AVG(f.rating) as avg_rating, COUNT(f.rating) as total_ratings
        FROM feedbacks f
        JOIN cafes c ON f.cafe_id = c.cafe_id
        WHERE c.status = 'Approved'  -- Only consider cafes that are approved
        GROUP BY f.cafe_id
        ORDER BY avg_rating DESC, total_ratings DESC
        LIMIT %s
    """
    df = pd.read_sql(query, conn, params=(top_n,))
    conn.close()

    recommendations = df.to_dict(orient='records')
    return recommendations

@app.route('/recommend', methods=['GET'])
def recommend():
    """Recommend cafes for a given user."""
    user_id = request.args.get('user_id')
    top_n = int(request.args.get('top_n', 5))

    if user_id is None:
        return jsonify({"error": "User ID is required."}), 400

    user_id = int(user_id)

    # Fetch feedback data and tags
    feedback_data = fetch_feedback_and_tags()

    # Check if feedback data is empty
    if feedback_data.empty:
        recommendations = fallback_recommendations(top_n)
        return jsonify({"recommendations": recommendations})

    # Check if the user exists in the feedback data
    if user_id not in feedback_data['user_id'].values:
        recommendations = fallback_recommendations(top_n)
        return jsonify({"recommendations": recommendations})

    # Train the model with feedback data
    model = train_model(feedback_data)

    # Generate predictions for all cafes
    unique_cafes = feedback_data[['cafe_id', 'cafe_tags']].drop_duplicates()
    user_tags = feedback_data[feedback_data['user_id'] == user_id]['user_tags'].iloc[0] if not feedback_data[feedback_data['user_id'] == user_id].empty else ''

    predictions = []
    for _, row in unique_cafes.iterrows():
        cafe_id = row['cafe_id']
        cafe_tags = row['cafe_tags']

        # Collaborative filtering predicted rating
        predicted_rating = model.predict(user_id, cafe_id).est

        # Tag similarity
        tag_similarity = calculate_tag_similarity(user_tags, cafe_tags)

        # Weighted prediction (adjust rating by tag similarity)
        final_score = predicted_rating + (tag_similarity * 0.5)  # Adjust weight as needed

        predictions.append((cafe_id, final_score))

    # Sort predictions by final score
    predictions = sorted(predictions, key=lambda x: x[1], reverse=True)

    # Get top N recommendations
    recommendations = [{"cafe_id": int(cafe_id), "predicted_rating": round(score, 2)} for cafe_id, score in predictions[:top_n]]

    return jsonify({
        "user_id": user_id,
        "recommendations": recommendations
    })

if __name__ == '__main__':
    app.run(debug=True)

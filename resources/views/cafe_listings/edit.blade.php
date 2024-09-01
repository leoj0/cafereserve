<x-owner-layout>
  <x-card>

    <h2 class="title-form">Edit Cafe</h2>

    <form method="POST" action="{{ route('cafes.update', $cafe->cafe_id) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label for="cafe_name">Cafe Name</label>
        <input type="text" class="form-control" id="cafe_name" name="cafe_name" value="{{ $cafe->cafe_name }}">
        @error('cafe_name')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
      </div>
    
      <div class="form-group">
        <label for="phone_number">Phone Number</label>
        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $cafe->phone_number }}">
        @error('phone_number')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
      </div>
    
      <div class="form-group">
        <label for="cafe_tags">Cafe Tags (Comma Separated)</label>
        <input type="text" class="form-control" id="cafe_tags" name="cafe_tags" value="{{ $cafe->cafe_tags }}">
        @error('cafe_tags')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
      </div>
    
      <div class="form-group">
        <label for="location">Location</label>
        <input type="text" class="form-control" id="location" name="location" value="{{ $cafe->location }}">
        @error('location')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
      </div>
    
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $cafe->email }}">
        @error('email')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
      </div>
    
      <div class="form-group">
        <label for="website">Website</label>
        <input type="url" class="form-control" id="website" name="website" value="{{ $cafe->website}}">
        @error('website')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="logo" >Cafe Logo</label>
        <input class="p-2 w-full" type="file" id="logo" name="logo">

        <img class="w-full h-full object-cover rounded"
        src="{{$cafe->logo ? asset ('storage/'.$cafe->logo) : asset('storage/images/default_image.jpg')}}"
        alt="Cafe Photo">

        @error('logo')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
      </div>
    
      <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3">{{ $cafe->description }}</textarea>
        @error('description')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
      </div>
    
      <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </form>

  </x-card>
</x-owner-layout>
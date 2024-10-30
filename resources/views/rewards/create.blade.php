<x-owner-layout>
    <x-card>
        <h2 class="form-title">Create Reward</h2>

        <form action="{{ route('rewards.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Hidden input for cafe_id -->
            <input type="hidden" name="cafe_id" value="{{ Auth::user()->cafe->cafe_id }}">

            <!-- Cafe Name -->
            <div>
                <input type="text" id="cafe_name" name="cafe_name" value="{{ Auth::user()->cafe->cafe_name ?? 'No Cafe Assigned' }}" class="form-input" readonly>
            </div>

            <!-- Reward Name -->
            <div class="mt-6">
                <input type="text" name="reward_name" id="reward_name" placeholder="Reward Name" value="{{ old('reward_name') }}" class="form-input" required>
                @error('reward_name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Reward Description -->
            <div class="mt-6">
                <textarea name="reward_description" id="reward_description" rows="4" placeholder="Reward Description" class="form-input" required>{{ old('reward_description') }}</textarea>
                @error('reward_description')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Points Required -->
            <div class="mt-6">
                <input type="number" name="points_required" id="points_required" placeholder="Points Required" value="{{ old('points_required') }}" class="form-input" required>
                @error('points_required')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-8">
                <button type="submit" class="form-button">Create Reward</button>
            </div>
        </form>
    </x-card>
</x-owner-layout>

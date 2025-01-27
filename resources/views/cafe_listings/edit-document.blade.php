<x-owner-layout>
  <x-card>
    <h2 class="form-title">Update Verification Documents</h2>

    <form method="POST" action="{{ route('cafes.updateDocuments', $cafe->cafe_id) }}" enctype="multipart/form-data">
      @csrf

      <div class="form-grid">
        <!-- SSM Certificate -->
        <div>
          <label for="ssm_certificate" class="block text-lg font-medium mb-2">Update SSM Certificate (PDF/JPG/PNG)</label>
          <input type="file" name="ssm_certificate" id="ssm_certificate" class="form-input">
          @if ($cafe->ssm_certificate)
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
              Current file: 
              <a href="{{ asset('storage/' . $cafe->ssm_certificate) }}" target="_blank" class="text-blue-500 hover:underline">
                View Current SSM Certificate
              </a>
            </p>
          @endif
        </div>

        <!-- Business License -->
        <div>
          <label for="business_license" class="block text-lg font-medium mb-2">Update Business License (PDF/JPG/PNG)</label>
          <input type="file" name="business_license" id="business_license" class="form-input">
          @if ($cafe->business_license)
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
              Current file: 
              <a href="{{ asset('storage/' . $cafe->business_license) }}" target="_blank" class="text-blue-500 hover:underline">
                View Current Business License
              </a>
            </p>
          @endif
        </div>
      </div>

      <button type="submit" class="form-button mt-4">Update Documents</button>
    </form>
  </x-card>
</x-owner-layout>

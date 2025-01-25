<x-owner-layout>
  <x-card>
    <h2 class="form-title">Upload Verification Documents</h2>

    <form method="POST" action="{{ route('cafes.submitDocuments', $cafe_id) }}" enctype="multipart/form-data">
      @csrf

      <div class="form-grid">
        <div>
          <label for="ssm_certificate" class="block text-lg font-medium mb-2">SSM Certificate (PDF/JPG/PNG)</label>
          <input type="file" name="ssm_certificate" id="ssm_certificate" class="form-input" required>
        </div>

        <div>
          <label for="business_license" class="block text-lg font-medium mb-2">Business License (PDF/JPG/PNG)</label>
          <input type="file" name="business_license" id="business_license" class="form-input" required>
        </div>
      </div>

      <button type="submit" class="form-button mt-4">Upload Documents</button>
    </form>
  </x-card>
</x-owner-layout>

<x-owner-layout>
  <x-horizontal-card>
    <div class="space-y-6">
      <!-- Page Title -->
      <h2 class="page_title">Uploaded Documents</h2>

      <!-- Documents Section -->
      <div class="space-y-4">
        <!-- SSM Certificate -->
        <div class="p-4 bg-gray-800 shadow rounded-lg border border-gray-600">
          <div class="flex justify-between items-center">
            <div>
              <h4 class="text-lg font-semibold text-white">
                <i class="fas fa-file-alt mr-2 text-gray-400"></i>SSM Certificate
              </h4>
              <p class="text-sm text-gray-400">Proof of business registration.</p>
            </div>
            <!-- Edit Icon -->
            <a 
              href="{{ route('cafes.editDocuments', ['cafe_id' => $cafe->cafe_id, 'document' => 'ssm_certificate']) }}" 
              class="text-blue-500 hover:text-blue-700 transition"
            >
              <i class="fas fa-pencil-alt"></i>
            </a>
          </div>
          <a 
            href="{{ asset('storage/' . $cafe->ssm_certificate) }}" 
            target="_blank" 
            class="inline-block mt-3 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition"
          >
            View Document
          </a>
        </div>

        <!-- Business License -->
        <div class="p-4 bg-gray-800 shadow rounded-lg border border-gray-600">
          <div class="flex justify-between items-center">
            <div>
              <h4 class="text-lg font-semibold text-white">
                <i class="fas fa-briefcase mr-2 text-gray-400"></i>Business License
              </h4>
              <p class="text-sm text-gray-400">Official business license document.</p>
            </div>
            <!-- Edit Icon -->
            <a 
              href="{{ route('cafes.editDocuments', ['cafe_id' => $cafe->cafe_id, 'document' => 'business_license']) }}" 
              class="text-blue-500 hover:text-blue-700 transition"
            >
              <i class="fas fa-pencil-alt"></i>
            </a>
          </div>
          <a 
            href="{{ asset('storage/' . $cafe->business_license) }}" 
            target="_blank" 
            class="inline-block mt-3 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition"
          >
            View Document
          </a>
        </div>
      </div>
    </div>
  </x-horizontal-card>
</x-owner-layout>

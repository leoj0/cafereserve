<x-admin-layout>
  <div class="min-h-screen bg-gray-50 p-6">
    <div class="bg-white rounded-xl shadow-lg p-6">
      <h1 class="text-2xl font-bold text-gray-900 mb-6">Cafe Status</h1>

      <!-- Filter Form -->
      <form action="{{ route('admin.index') }}" method="GET" class="mb-6">
        <div class="flex gap-x-3">
          <input 
            type="text" 
            name="search" 
            placeholder="Search cafes..." 
            value="{{ request('search') }}" 
            class="bg-white text-gray-900 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none shadow-sm"
          />
          <select name="status" class="bg-white text-gray-900 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none shadow-sm">
            <option value="">All Status</option>
            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Approved" {{ request('status') == 'Approved' ? 'selected' : '' }}>Approved</option>
            <option value="Denied" {{ request('status') == 'Denied' ? 'selected' : '' }}>Denied</option>
          </select>
          <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200 font-medium shadow-sm">
            Filter
          </button>
        </div>
      </form>

      @if($cafes->isEmpty())
        <p class="text-gray-500 text-center py-8">No cafes to display.</p>
      @else
        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-sm">
          <table class="w-full">
            <thead>
              <tr class="bg-gray-50">
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 border-b border-gray-200">Cafe Name</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 border-b border-gray-200">Location</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 border-b border-gray-200">Tags</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 border-b border-gray-200">Documents</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 border-b border-gray-200">Status</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 border-b border-gray-200">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              @foreach($cafes as $cafe)
                <tr class="bg-white hover:bg-gray-50 transition-colors">
                  <td class="px-6 py-4">
                    <a href="{{ route('cafes.show', $cafe->cafe_id) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                      {{ $cafe->cafe_name }}
                    </a>
                  </td>
                  <td class="px-6 py-4 text-gray-900">{{ $cafe->location }}</td>
                  <td class="px-6 py-4">
                    <span class="px-3 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">{{ $cafe->cafe_tags }}</span>
                  </td>
                  <td class="px-6 py-4">
                    @if($cafe->ssm_certificate && $cafe->business_license)
                      <div class="space-x-2">
                        <a href="{{ asset('storage/' . $cafe->ssm_certificate) }}" target="_blank" 
                           class="text-blue-600 hover:text-blue-800 text-sm">SSM Certificate</a>
                        <a href="{{ asset('storage/' . $cafe->business_license) }}" target="_blank"
                           class="text-blue-600 hover:text-blue-800 text-sm">Business License</a>
                      </div>
                    @else
                      <span class="text-gray-500 text-sm">No document uploaded</span>
                    @endif
                  </td>
                  <td class="px-6 py-4">
                    @if($cafe->status == 'Approved')
                      <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Approved</span>
                    @elseif($cafe->status == 'Denied')
                      <span class="px-3 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Denied</span>
                    @else
                      <span class="px-3 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Pending</span>
                    @endif
                  </td>
                  <td class="px-6 py-4">
                    <form action="{{ route('admin.updateStatus', $cafe->cafe_id) }}" method="POST" class="space-y-3">
                      @csrf
                      @method('PUT')
                      <textarea name="comment" rows="2" placeholder="Add a comment..." 
                        class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none outline-none shadow-sm"></textarea>
                      <div class="flex gap-x-2">
                        <button type="submit" name="status" value="Approved" 
                          class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors duration-200 text-sm font-medium shadow-sm">
                          Approve
                        </button>
                        <button type="submit" name="status" value="Denied" 
                          class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors duration-200 text-sm font-medium shadow-sm">
                          Deny
                        </button>
                      </div>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
          {{ $cafes->appends(request()->query())->links('pagination::tailwind') }}
        </div>
      @endif
    </div>
  </div>
</x-admin-layout>

<x-layout>
  <x-horizontal-card>
    <div class="flex justify-between items-center mb-4">
      <h2 class="page_title">User Information</h2>

      <div class="relative">
        <button id="profileDropdownButton" class="text-gray-500 hover:text-gray-700 focus:outline-none p-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
          </svg>
        </button>

        <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-md shadow-lg z-20">
          <ul class="py-1">
            <li>
              <a href="/users/{{ $user->user_id }}/edit" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition duration-150 ease-in-out">
                <i class="fas fa-pencil-alt mr-2"></i>Edit Profile
              </a>
            </li>
            <li>
              <form action="{{ route('user.delete', ['user' => $user->user_id]) }}" method="POST" 
                    onsubmit="return confirm('Are you sure you want to delete this profile?');">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 transition duration-150 ease-in-out">
                  <i class="fas fa-trash-alt mr-2"></i>Delete Profile
                </button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="p-4 bg-gray-800 shadow rounded-lg border border-gray-600">
        <h3 class="text-lg font-semibold text-white">
          <i class="fas fa-user mr-2 text-gray-400"></i>Name
        </h3>
        <p class="text-gray-400">{{ $user->name }}</p>
      </div>
      <div class="p-4 bg-gray-800 shadow rounded-lg border border-gray-600">
        <h3 class="text-lg font-semibold text-white">
          <i class="fas fa-user-tag mr-2 text-gray-400"></i>Role
        </h3>
        <p class="text-gray-400">{{ $user->role }}</p>
      </div>
      <div class="p-4 bg-gray-800 shadow rounded-lg border border-gray-600">
        <h3 class="text-lg font-semibold text-white">
          <i class="fas fa-envelope mr-2 text-gray-400"></i>Email
        </h3>
        <p class="text-gray-400">{{ $user->email }}</p>
      </div>
      <div class="p-4 bg-gray-800 shadow rounded-lg border border-gray-600">
        <h3 class="text-lg font-semibold text-white">
          <i class="fas fa-tags mr-2 text-gray-400"></i>Tags
        </h3>
        <p class="text-gray-400">{{ $user->user_tags }}</p>
      </div>
    </div>
  </x-horizontal-card>
</x-layout>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const profileDropdownButton = document.getElementById('profileDropdownButton');
    const profileDropdown = document.getElementById('profileDropdown');

    profileDropdownButton.addEventListener('click', function(event) {
      event.stopPropagation();
      profileDropdown.classList.toggle('hidden');
    });

    document.addEventListener('click', function(event) {
      if (!profileDropdown.contains(event.target) && event.target !== profileDropdownButton) {
        profileDropdown.classList.add('hidden');
      }
    });
  });
</script>


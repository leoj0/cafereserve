<x-layout>
  <x-card>
    <h2 class="title-form">User Information</h2>
    <table class="table table-bordered">
      <tr>
        <th>Name</th>
        <td>{{$user->name}}</td>
      </tr>
      <tr>
        <th>Role</th>
        <td>{{$user->role}}</td>
      </tr>
      <tr>
        <th>Email</th>
        <td>{{$user->email}}</td>
      </tr>
      <tr>
        <th>Tags</th>
        <td>{{$user->user_tags}}</td>
      </tr>
    </table>

    <div class="card bg-light">
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <a href="/users/{{$user->user_id}}/edit" class="btn btn-primary btn-block">
              <i class="fas fa-edit"></i> Edit
            </a>
          </div>
          <div class="col-6">
            <form method="POST" action="{{ route('user.delete', ['user' => $user->user_id]) }}">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-block">
                <i class="fas fa-trash-alt"></i> Delete
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </x-card>
</x-layout>
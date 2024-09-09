<x-layout>
  <x-horizontal-card>
    <div class="container">
      <h1>My Rewards</h1>

      <div class="card mb-4">
        <div class="card-body">
          <h2 class="card-title">Your Points</h2>
          <p class="card-text">You currently have <strong>{{ $points }}</strong> loyalty points.</p>
        </div>
      </div>

      <h2>Claimed Rewards</h2>

      @if($claimedRewards->isEmpty())
      <p>You haven't claimed any rewards yet.</p>
      @else
      <div class="row">
        @foreach($claimedRewards as $claimedReward)
        <div class="col-md-4 mb-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ $claimedReward->reward->reward_name }}</h5>
              <p class="card-text">Claimed on: {{ $claimedReward->claimed_at->format('M d, Y') }}</p>
              @if($claimedReward->used_at)
              <p class="card-text text-muted">Used on: {{ $claimedReward->used_at->format('M d, Y') }}</p>
              @else
              <p class="card-text text-success">Available for use</p>
              @endif
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @endif
    </div>
  </x-horizontal-card>
</x-layout>
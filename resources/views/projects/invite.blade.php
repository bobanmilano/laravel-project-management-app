 
<div class="card flex flex-col mt-6">
            
      <div class="-ml-5">
          <div class="tts"></div>
          <h3 class="py-3 mb-4 ml-4 font-normal text-xl">
            Invite a User
          </h3>
      </div>
                
      <form method="POST" action="{{ $project->path() . '/invitations'}}" class="text-right mt-4">
        @csrf
          <div class="mb-3">
              <input type='email' name="email" class="py-2 px-3 border w-full border-grey rounded" placeholder="Email address">
          </div>

          <button type="submit" class="text-xs button">Invite</button>
      </form>

      @include('errors', ['bag' => 'invitations'])
                   
</div>
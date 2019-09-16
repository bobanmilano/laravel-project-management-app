 

 <div class="card flex flex-col mt-6">
            
                    <h3 class="py-3 mb-4 font-normal text-xl">
                      Invite a user
                    </h3>
                
                      <form method="POST" action="{{ $project->path() . '/invitations'}}" class="text-right mt-4">
                        @csrf
                          <div class="mb-3">
                              <input type='email' name="email" class="py-2 px-3 border w-full border-grey rounded" placeholder="Email address">
                          </div>

                          <button type="submit" class="text-xs button">Invite</button>
                      </form>

                     @include('errors', ['bag' => 'invitations'])

                   
                  </div>
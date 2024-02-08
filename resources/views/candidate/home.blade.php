<x-app-layout>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
    
                        <h1 class="text-white">You are in Candidate Dashboard!</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    </x-app-layout>
    
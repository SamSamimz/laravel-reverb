<div class="container">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card chat-app">
                <div id="plist" class="people-list" style="max-height: 700px; overflow-y: auto">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>
                    <ul class="list-unstyled chat-list mt-2 mb-0">
                        @foreach ($users as $user)
                        <li class="clearfix" wire:click='changeSelectedUser({{$user}})'>
                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
                            <div class="about">
                                <div class="name">{{ $user->username }}</div>
                                <div class="status"> <i class="fa fa-circle offline"></i> {{ $user->last_active_at }} </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="chat">
                    <div class="chat-header clearfix">
                        <div class="row">
                            @if ($selectedUser)
                            <div class="col-lg-6">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                </a>
                                <div class="chat-about">
                                    <h6 class="m-b-0">{{ @$selectedUser->name }}</h6>
                                    <small>{{ @$selectedUser->activeStatus() }}</small>
                                </div>
                            </div>
                            @endif
                            <div class="col-lg-6 hidden-sm text-right">
                                <a href="javascript:void(0);" class="btn btn-outline-secondary"><i
                                        class="fa fa-camera"></i></a>
                                <a href="javascript:void(0);" class="btn btn-outline-primary"><i
                                        class="fa fa-image"></i></a>
                                <a href="javascript:void(0);" class="btn btn-outline-info"><i
                                        class="fa fa-cogs"></i></a>
                                <a href="javascript:void(0);" class="btn btn-outline-warning"><i
                                        class="fa fa-question"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="chat-history" style="height: 650px; overflow-y: auto">
                        <ul class="m-b-0">
                            @forelse ($messages as $message)
                            <li class="clearfix {{ $message->sender->id === auth()->user()->id ? 'text-right' : '' }}">
                                <div class="message-data">
                                    <span class="message-data-time">{{ $message->messageTime() }}</span>
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                                </div>
                                <div class="message other-message"> {{ $message->text }} </div>
                            </li>
                            @empty
                                
                            @endforelse
                        </ul>
                    </div>
                    <div class="chat-message clearfix">
                        <form wire:submit.prevent="sendMessage">
                            <div class="input-group mb-0">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="cursor: pointer;" wire:click="sendMessage">
                                        <i class="fa fa-send"></i>
                                    </span>
                                </div>
                                <input wire:model="message" type="text" class="form-control" placeholder="Enter text here...">
                            </div>
                        </form>        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
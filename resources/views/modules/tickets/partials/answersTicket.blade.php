
@if(\Auth()->user()->id == $reply->user_id)
    <div class="chat-message-right pb-4 mb-4">
        <div>
            <img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
            <div class=" small text-nowrap mt-2">{{ \Carbon\Carbon::parse($reply->created_at)->diffForHumans() }}</div>
        </div>
        <div class="flex-shrink-1 rounded py-2 px-3 mr-3 w-100 border"   style="background-color: rgb(240, 242, 245)">
            <small class="float-right">
                <em>
                    {{ $reply->created_at }}
                    {{-- @if(Auth()->user()->role_id!=2)
                    @foreach($ticket->replies as $reply)
                        @if($reply === $ticket->replies->last())
                            {{ $ticket->state_clock }}
                        @endif
                    @endforeach
                    @endif --}}
                </em>
            </small>
            <div class="font-weight-bold mb-1">Tú</div>
            <small><em>{{ Auth()->user()->role_id===2 ? 'Cliente' : 'Soporte'  }}</em></small>
            {!! $reply->replie !!}
            {{-- archivos--}}
            @if(count($reply->files)>0)
                <div class="border-top mt-2 mb-2"></div>
                @foreach ($reply->files as $key => $file )
                    <a class="btn btn-{{ \App\Models\Helpers::getIconFile($file->extension)['color'] }}
                        mr-3 mb-3"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="{{$file->name_original}}"
                        data-original-title="Tooltip on top"
                        href="{{ Storage::url($file->path) }}"
                        target="_blank">
                        <i class="{!! \App\Models\Helpers::getIconFile($file->extension)['icon'] !!} " style='font-size: 25px;'></i>
                    </a>
                @endforeach
            @endif
            {{-- visita tecnica --}}
            <div class="border-top mt-2 mb-2"></div>
            @if(Auth()->user()->role_id!=2)
                <button
                    class="btn btn-success btn-sm text-white float-right addVisit"
                    data-toggle="tooltip"
                    title=""
                    data-placement="top"
                    data-original-title="Nueva visita tecnica"
                    type="button"
                    data-replieId="{{ $reply->id}}">
                    <span>
                        <i class="fa fa-plus"></i>
                    </span>
                </button>
            @endif
        </div>
    </div>
@else
    <div class="chat-message-left pb-4  mb-4">

        <div class="flex-shrink-1 rounded py-2 px-3 ml-3 w-100" style="background-color: rgb(176, 221, 247)">
            <small class="float-right">
                <em>
                    {{ $reply->created_at }}
                </em>
            </small>
            <div class="font-weight-bold mb-1">{{  $reply->user ? $reply->user->name : '---'  }}</div>
            <small><em>{{ $reply->user->role_id==2 ? 'Cliente' : 'Soporte'  }}</em></small>
            {!! $reply->replie !!}
             {{-- archivos--}}
             @if(count($reply->files)>0)
             <div class="border-top mt-2 mb-2"></div>
                @foreach ($reply->files as $key => $file )
                    <a class="btn btn-{{ \App\Models\Helpers::getIconFile($file->extension)['color'] }}
                        mr-3 mb-3"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="{{$file->name_original}}"
                        data-original-title="Tooltip on top"
                        href="{{ Storage::url($file->path) }}"
                        target="_blank">
                        <i class="{!! \App\Models\Helpers::getIconFile($file->extension)['icon'] !!} " style='font-size: 25px;'></i>
                    </a>
                @endforeach
            @endif
            {{-- visita tecnica --}}
            <div class="border-top mt-2 mb-2"></div>
            @if(Auth()->user()->role_id!=2)
                <button
                    class="btn btn-success btn-sm text-white float-right addVisit"
                    data-toggle="tooltip"
                    title=""
                    data-placement="top"
                    data-original-title="Nueva visita tecnica"
                    type="button"
                    data-replieId="{{ $reply->id}}">
                    <span>
                        <i class="fa fa-plus"></i>
                    </span>
                </button>
            @endif
        </div>
    </div>
@endif

{{-- visitas tecnicas --}}
@if (count($reply->ticketsVisits)>0)
    <div class="row mb-5 mx-1">
        <div class="border-grey col-12">
            @foreach ($reply->ticketsVisits as $ticketVisit)
                <div
                    data-toggle="tooltip"
                    title=""
                    data-placement="top"
                    data-original-title=" {{ $ticketVisit->description }}"
                    class="pointer">
                    <div class="row">
                        <div class="col-sm-10">
                            <b><em>Visita técnica</em></b><br>
                        </div>
                        <div class="col-sm-2">
                            <div class="small text-nowrap float-right">{{ $ticketVisit->created_at }}</div>
                        </div>
                    </div>
                    <div class="pointer border-top-cs"></div>
                    <div>
                        <b>Técnicos:</b>
                        <span class="ml-2">
                            @foreach ($ticketVisit->employees as $employeeT)
                                {{ $employeeT->short_name }},&nbsp
                            @endforeach
                        </span>
                    </div>
                    <div>
                        <b>Fecha:</b>
                        <span class="ml-2">
                            {{ $ticketVisit->date }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif




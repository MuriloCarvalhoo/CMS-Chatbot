
@php
    $lastConversa = "";
@endphp

@foreach($data as $key => $value)

@php
    $firstConversa = $value['conversa'];
@endphp

@if ($firstConversa !== $lastConversa)
    

<div class="app-item">
    <div class="app-info" data-action='SHOW' data-load-to="#app-entry"
        data-url="{{guard_url('chatbox/chatbox')}}/{{$value['id']}}">
        <input type="checkbox" name="tasks_list" id="task_{{$firstConversa}}">
        <label class="app-project-name bg-secondary" for="task_{{$firstConversa}}">{{$firstConversa[0]}}</label>
        <h3>{{$firstConversa}}</h3>
        <div class="app-metas">
            <span class="badge badge-status in-progress">Conversa Gerada</span>
        </div>
    </div>
    <div class="app-actions">
        <a href="{{guard_url('chatbox/chatbox')}}/{{$value['id']}}" class="btn las la-pencil-alt" data-action='EDIT'
            data-load-to="#app-entry" data-url="{{guard_url('chatbox/chatbox')}}/{{$value['id']}}/edit">
        </a>
        <div class="dropdown">
            <a href="#" class="btn las la-ellipsis-h dropdown-toggle" href="#" role="button"
                id="app_quick_menu_{{$firstConversa}}" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false"></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="app_quick_menu_{{$firstConversa}}">
                <a class="dropdown-item" href="#appDetailModal" data-toggle="modal" data-target="#appDetailModal"><i
                        class="las la-eye"></i>View</a>
                <a class="dropdown-item" href="#"><i class="las la-copy"></i>Copy</a>
                <a class="dropdown-item" href="#"><i class="las la-inbox"></i>Archive</a>
                <a class="dropdown-item" href="{{guard_url('chatbox/chatbox')}}/{!!$value['id']!!}" data-action='DELETE'
                data-load-to="#app-entry" data-list="#item-list"
                data-url="{{guard_url('chatbox/chatbox')}}/{!!$value['id']!!}"><i class="las la-times text-danger"></i>Delete</a>
            </div>
        </div>
    </div>
</div>

@endif


@php
    $lastConversa = $firstConversa;    
@endphp

@endforeach
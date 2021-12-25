@if(session('success'))  
    <div class="alert alert-success alert-flash">
        {!! session('success') !!}
    </div>
@elseif(isset($success))
    <div class="alert alert-success alert-flash">
        {!! $success !!}
    </div>
@endif

@if(session('message'))
    <div class="alert alert-primary alert-flash">
        {!! session('message') !!}
    </div>
@elseif(isset($message))
    <div class="alert alert-primary alert-flash">
        {!! $message !!}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
@else
    @if(session('error'))  
        <div class="alert alert-danger alert-flash">
            {!! session('error') !!}
        </div>
    @else
        @if(isset($error))
            <div class="alert alert-danger alert-flash">
                {!! $error !!}
            </div>
        @endif
    @endif
@endif
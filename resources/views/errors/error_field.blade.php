<span class="help-block">

@if(!str_contains($field,'*'))
    <strong>{{ $errors->first($field) }}</strong>
@else
    <ul>

        @foreach($errors->get($field) as $error)
            <li>{{ $error[0] }}</li>
        @endforeach
    
    </ul>
@endif


</span>
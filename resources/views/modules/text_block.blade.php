@foreach($v as $aa=>$val)

        <div>{{ $val->id }}</div>
        <div>{{ $val->title }}</div>
        <div>{{ $val->text }}</div>

    @endforeach
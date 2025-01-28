<table class="">
    <thead>
    <tr>
{{--        <th>{{trans('general.id')}}</th>--}}
        <th >@langucw('icon')</th>
        <th >{{trans('general.name')}}</th>
        <th >@langucw('date')</th>
        <th >{{trans('general.action')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach(getLogged()->userOccasion()->get() as $index=>$occasion)
        <tr>
{{--            <td>{{ $index }}</td>--}}
            <td>
                @if($occasion->getFirstMediaUrl('user_occasion','small'))
                    <img width="100px" height="100px" src="{{\App\Services\UserOccasionService::getImage($occasion)??''}}" class="img-thumbnail">
                @else
                    <img width="100px" height="100px" src="{{asset($occasion->categoriesOccasion->getFirstMediaUrl('categories_occasion', 'small'))}}" class="img-thumbnail">
                @endif
            </td>
            <td>{{$occasion->title}}</td>
            <td>{{ $occasion->date }}</td>
            <td>
                <a class="btn btn-pink-cake mar-right-10" href="{{route('user_occasions.edit',$occasion)}}">@langucw('edit')</a>
                <button onclick="deleteItemInUserOccasions('{{route('user_occasions.delete',$occasion)}}')"  class="btn btn-pink-cake mar-right-10">@langucw('delete')</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

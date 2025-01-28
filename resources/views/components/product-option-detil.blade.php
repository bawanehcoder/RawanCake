@if(count($options)>0)
    @foreach($options as $optin)
        <div class=" mb-3">
            <div class="form-group">
                <label for="colorBy">{{$optin[0]->subOption->itemOption->getTitle()}}</label>
                <div class="select-wrapper">
                    <select att="{{$optin[0]->subOption->itemOption->id}}" id="OptID" name="OptID"
                            class="selectCom form-control w-100  ">
                        @foreach($optin as $item)
                            <option data-price="{{$item->AdditionalValue}}" value="{{$item->id}}">
                                {{ \Config::get('app.locale') == 'en' ? $item->subOption['NameEN'] : $item->subOption['Name'] }}
                                 |
                                + {{$item->AdditionalValue}}</option>

                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    @endforeach
@endif


    <div class="myaccount-content account-details">
        <div class="account-details-form">
            <div >
                <div class="row g-4">
                    <div class="col-md-6 col-12">
                        <div class="single-input-item">
                            <label for="first-name">{{trans('general.name')}} <abbr class="required"></abbr></label>
                            <input class="form-field" type="text" value="{{getLogged()->name}}" id="name">
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <label for="email">@langucw('phone')<abbr class="required"></abbr></label>
                        <input class="form-field" type="text" id="phone" value="{{getLogged()->phone}}">
                    </div>

                    <div class="col-md-6 col-12">
                        <label for="email">@langucw('gender')<abbr class="required"></abbr></label>
                        <div class="select-wrapper  col">

                            <select autocomplete="off" class="form-field" id="gender" name="gender">

                                <option {{getLogged()->gender=='male'? 'selected' : ''}}  value="{{0}}">@langucw('male')</option>
                                <option {{getLogged()->gender=='female'? 'selected' : ''}}  value="{{1}}">@langucw('female')</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <label for="email">@langucw('zones')<abbr class="required"></abbr></label>
                        <div class="select-wrapper  col">
                            <select autocomplete="off" class="form-field" id="zone" name="zone">
                                @foreach( app()->make(\App\Repositories\ZoneRepository::class)->getAll()??[] as $index=>$zone)
                                    <option
                                        {{getLogged()->ZoneID==$zone->id? 'selected' : ''}}  value="{{$zone->id}}">{{$zone['Addres'.getLang()]}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if(getLogged()->LoginProvider==null)
                    <div class="col-12">
                        <fieldset>
                            <legend>@langucw('password change')</legend>
                            <div class="row g-4">
                                <div class="col-12">
                                    <label for="current-pwd">@langucw('current password') (@langucw('leave blank to leave unchanged'))</label>
                                    <input class="form-field" type="password" id="current-pwd">
                                </div>
                                <div class="col-12">
                                    <label for="new-pwd">@langucw('new password') (@langucw('leave blank to leave unchanged'))</label>
                                    <input class="form-field" type="password" id="new-pwd">
                                </div>

                            </div>
                        </fieldset>
                    </div>
                    @endif
                    <div class="col-12">
                        <button onclick="updateProfile()" class="btn btn-dark btn-primary-hover">@langucw('save changes')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



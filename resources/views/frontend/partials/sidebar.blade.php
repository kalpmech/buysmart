<div class="shop__sidebar">
    <div class="sidebar__sizes">
        <div class="section-title">
            <h4>Category</h4>
            <button type="submit" value="filter" >Filter</button>
            @php
                $urlPara = explode('/',Request::path());
            @endphp
            @isset($urlPara[0])
               <a href="{{route($urlPara[0])}}">Clear</a>
            @endisset
        </div>
        <div class="size__list">
            @foreach ($categories as $id => $category)
                <label for="{{$category}}">
                    <input type="checkbox" id="{{$category}}" value="{{$id}}" name="category_id[]" {{ (isset($_GET['category_id']) && is_array($_GET['category_id']) && in_array($id, $_GET['category_id'])) ? ' checked' : '' }}>{{$category}}
                    <span class="checkmark"></span>
                </label>
            @endforeach
        </div>
    </div>
    <div class="sidebar__filter">
        <div class="filter-range-wrap">
            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="0" data-max="2000"></div>
            <div class="range-slider">
                <div class="price-input">
                    <p>Price:</p>
                    <input type="text" id="minamount" name="min" value="{{isset($_GET['min'])}}">
                    <input type="text" id="maxamount" name="max" value="{{isset($_GET['max'])}}" style="max-width:22% !important">
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar__sizes">
        <div class="section-title">
            <h4>Shop by size</h4>
        </div>
        <div class="size__list">
            {{old('max')}}
            @foreach (Config::get('constants.size') as $item)
                <label for="{{$item}}">
                    <input type="checkbox" id="{{$item}}" value="{{$item}}" name="size[]" 
                    {{ isset($_GET['size']) && (is_array($_GET['size']) && in_array($item, $_GET['size'])) ? ' checked' : '' }}
                    >{{$item}}
                    <span class="checkmark"></span>
                </label>
            @endforeach
        </div>
    </div>
    <div class="sidebar__color">
        <div class="section-title">
            <h4>Shop by Color</h4>
        </div>
        <div class="size__list color__list">
            @foreach (Config::get('constants.color') as $item)
                <label for="{{$item}}">
                    <input type="checkbox" id="{{$item}}" value="{{$item}}" name="color[]" {{ (isset($_GET['color']) && is_array($_GET['color']) && in_array($item, $_GET['color'])) ? ' checked' : '' }}>{{$item}}
                    <span class="checkmark"></span>
                </label>
            @endforeach
        </div>
    </div>
</div>
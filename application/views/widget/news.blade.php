<section id="news" class="section-bg">
    <div class="container" id="tintuc">
        <header class="section-header">
            <h3>
                {{lang('News')}}
            </h3>
        </header>
        <div class='row justify-content-center'>
            <div id="search-new" class="col-md-6 col-12">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control input_search" placeholder="{{lang("search")}}">
                        <div class="input-group-append bg-success border-primary button_search" style="cursor: pointer;">
                            <span class="input-group-text bg-transparent text-white"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row data justify-content-center">

        </div>
    </div>

    <div class="container pt-5" id="product">
        <header class="section-header">
            <h3>
                {{lang('News_product')}}
            </h3>
        </header>
        <div class='row justify-content-center'>
            <div id="search-new" class="col-md-6 col-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <select id="filter_category">
                            <option value="0">All</option>
                            @foreach($category as $row)
                            <option value="{{$row['id']}}">{{$row[pick_language($row,"name_")]}}</option>
                            @endforeach
                        </select>
                    </div> 
                    <input type="text" class="form-control input_search" placeholder="{{lang("search")}}">
                    <div class="input-group-append bg-success border-primary button_search" style="cursor: pointer;">
                        <span class="input-group-text bg-transparent text-white"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row data justify-content-center">

        </div>
    </div>
</section>
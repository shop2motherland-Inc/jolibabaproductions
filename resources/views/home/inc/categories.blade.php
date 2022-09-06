<?php
$hideOnMobile = '';
if (isset($categoriesOptions, $categoriesOptions['hide_on_mobile']) and $categoriesOptions['hide_on_mobile'] == '1') {
    $hideOnMobile = ' hidden-sm';
}
?>
<style>
    .h-ph-7 {
        padding-left: 7px;
    }

    .h-ph-7,
    .h-pr-7 {
        padding-right: 7px;
    }

    .b-categories-item {
        cursor: pointer;
        display: block;
        font-size: 14px;
        padding: 7px 10px;
        outline: none !important;
        text-decoration: none !important;
    }

    a {
        text-decoration: none;
    }

    a,
    a:focus,
    a:hover {
        text-decoration: none;
    }

    * {
        box-sizing: border-box;
    }

    * {
        margin: 0;
        padding: 0;
    }

    * {
        box-sizing: border-box;
    }

    body {
        font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
        font-size: 13px;
    }

    .b-categories-item--outer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 32px;
    }

    .h-flex-center {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .b-categories-item-icon__image {
        width: 30px;
        height: 30px;
    }

    .b-categories-item--inner {
        padding: 0 8px;
        color: grey;
        font-weight: 300;
        display: flex;
        flex-direction: column;
        /* align-items: center; */
    }

    .card-body {
        padding: 0.8rem;
    }
    #maincategory1:hover{
        background-color: #d8d8d9;
    }

/* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #467ad0; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background:#888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #467ad0; 
}
.b-categories-item:hover
{
    background-color: #d6dbdd;
}
.subcatogorylist:hover{
    background-color: #fa7722;
}

.cat-item {
    position: relative;
}

.sub-categories {
    position: absolute;
    display: none !important;
    width: 100%;
    right: -105px;
    max-height: 300px;
    top: 0;
    z-index: 100;
    left: 100%;
}

.cat-item:hover .sub-categories, .cat-item:hover .sub-categories:hover {
    display: block !important;
}
</style>
@if (isset($categoriesOptions) and isset($categoriesOptions['cat_display_type']))
@includeFirst([config('larapen.core.customizedViewPath') . 'home.inc.spacer', 'home.inc.spacer'],
['hideOnMobile' => $hideOnMobile])
<div class="container{{ $hideOnMobile }}">
    <div class="col-xl-12 layout-section">
        <div class="row row-featured row-featured-category " >
            {{-- <div class="col-md-12 box-title no-border">
                <div class="inner">
                    <h2>
                        <span class="title-3">{{ t('Browse by') }} <span style="font-weight: bold;">{{ t('category') }}</span></span>
                        <a href="{{ \App\Helpers\UrlGen::sitemap() }}" class="sell-your-item">
                            {{ t('View more') }} <i class="fas fa-bars"></i>
                        </a>
                    </h2>
                </div>
            </div> --}}
            <div class="d-md-none d-sm-flex" style="box-sizing: border-box;">
                <div class="row ">
                    @if (isset($categories) and $categories->count() > 0)
                                @foreach ($categories as $key => $cat)
                                     <!-- <div style="border: 3px solid #fafafa;"> -->
                                        <div class="col-4">
                                           
                                            <div id="singlecat" style="display: flex;justify-content: center;align-items: center;height: 150px;flex-direction: column;">
                                                @if (in_array(config('settings.list.show_category_icon'), [2, 6, 7, 8]))
                                                    <i class="{{ $cat->icon_class ?? 'fas fa-folder' }}" style="font-size: 3rem;"></i>
                                                @endif
                                                <div class="b-categories-item--inner mt-1 text-center"><span class="qa-category-parent-name
                                        b-category-parent-name">
                                               <a href="{{ \App\Helpers\UrlGen::category($cat) }}"> {{ $cat->name }}</a>
                                            </span>
                                            </span>
                                            </div>
                                            </div>
                                        <!-- </div> -->
                                    </div>
                                @endforeach
                            @endif
                </div>
            </div>

            <div class="col-3 d-none d-md-block">
                <div class="bg-white" style="position: relative;">
                    @if ($categoriesOptions['cat_display_type'] == 'c_picture_list')

                    @if (isset($categories) and $categories->count() > 0)
                    @foreach ($categories as $key => $cat)
                   

                    <div class="maincategory1">
                        <a class="b-categories-item h-ph-7 qa-category-parent-item " id="maincategory1" href="{{ \App\Helpers\UrlGen::category($cat) }}" data-index="0">
                            <span class="b-categories-item--outer"><span class="h-flex-center">
                                    <div class="h-flex-center b-categories-item-icon__image">
                                        <div class="b-static-image b-subcategory-item__icon" style=" display: flex;align-content: center;">
                                     
                                            @if (in_array(config('settings.list.show_category_icon'), [2, 6, 7, 8]))
                                            <i class="{{ $cat->icon_class ?? 'fas fa-folder' }}"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <span class="b-categories-item--inner">
                                        <span class="qa-category-parent-name
					                					b-category-parent-name">
                                            {{ $cat->name }}
                                        </span>
                                        <span class="b-list-category-stack__item-link--found b-black">
                                            <span>
                                                @if (config('settings.list.count_categories_listings'))
                                                &nbsp;({{ $countPostsByCat->get($cat->id)->total ?? 0 }})
                                                @endif
                                            </span>
                                        </span>
                                    </span>
                                </span> <svg stroke-width="0" class="arrow-right" style="width: 10px; height: 10px; max-width: 10px; max-height: 10px; fill: rgb(48, 58, 75); stroke: inherit;">
                                    <use xlink:href="#arrow-right"></use>
                                    <i class="fas fa-chevron-right"></i>
                                </svg>
                            </span>
                        </a>
                    </div>
                    @endforeach
                    @endif
                    @elseif ($categoriesOptions['cat_display_type'] == 'c_bigIcon_list')
                    @if (isset($categories) and $categories->count() > 0)
                    @foreach ($categories as $key => $cat)

                    <!-- <div class="col-lg-2 col-md-3 col-sm-4 col-6 f-category">
        <a href="{{ \App\Helpers\UrlGen::category($cat) }}">
         @if (in_array(config('settings.list.show_category_icon'), [2, 6, 7, 8]))
<i class="{{ $cat->icon_class ?? 'fas fa-folder' }}"></i>
@endif
         <h6>
          {{ $cat->name }}
          @if (config('settings.list.count_categories_listings'))
&nbsp;({{ $countPostsByCat->get($cat->id)->total ?? 0 }})
@endif
         </h6>
        </a>
       </div> -->

                    <div id="cat_id-{{$cat->id}}" class="cat-item">
                        <!--onmouseleave="removeCat()" -->

                        {{-- <a    onmouseenter="show_subcategories({{$cat->id}},'{{URL("category")}}')" href="{{ \App\Helpers\UrlGen::category($cat) }}"   id="cat_id " class="b-categories-item h-ph-7 qa-category-parent-item" data-index="0"><span class="b-categories-item--outer"><span class="h-flex-center"> --}}
                            <a    href="{{ \App\Helpers\UrlGen::category($cat) }}"   id="cat_id " class="b-categories-item h-ph-7 qa-category-parent-item" data-index="0"><span class="b-categories-item--outer"><span class="h-flex-center">
                                    <div class="h-flex-center b-categories-item-icon__image">
                                        <div class="b-static-image b-subcategory-item__icon" style=" display: flex;align-content: center;">
                                            <!--   <img height="32px" width="32px"
                                            src="https://assets.jiji.ng/art/attributes/categories/vehicles.png"
                                            class="icon" style=""> -->
                                            @if (in_array(config('settings.list.show_category_icon'), [2, 6, 7, 8]))
                                            <i class="{{ $cat->icon_class ?? 'fas fa-folder' }}"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <span class="b-categories-item--inner"><span class="qa-category-parent-name
                					b-category-parent-name">
                                            {{ $cat->name }}
                                        </span> <span class="b-list-category-stack__item-link--found b-black"><span>
                                                @if (config('settings.list.count_categories_listings'))
                                                &nbsp;({{ $countPostsByCat->get($cat->id)->total ?? 0 }})
                                                @endif
                                            </span></span></span>
                                </span>     <i class="fas fa-chevron-right"></i></span>
                            </a>
                                
                            @php
                            $subCategories = App\Models\Category::where('parent_id', $cat->id)
                                                                  ->where('active', 1)
                                                                  ->get();
                            @endphp

                            <div class="sub-categories">
                                <div class="" style="background-color:#467ad0">
                                    <ul class="cat-list">
                                        @foreach ($subCategories as $subCat)
                                        <li class="subcatogorylist text-lg" style="border-bottom: #0060ff 1px solid;display:flex;flex-direction:row;align-items:center">
                                            <i class="fas fa-phone-alt" style="color:#fff;display:inline-block;margin-left:20px;"></i>
                                            <a href="{{ \App\Helpers\UrlGen::category($subCat) }}" style="color:white;padding:10px  0px 10px 20px;display:inline-block">{{ $subCat->name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    @endif
                    @elseif (in_array($categoriesOptions['cat_display_type'], ['cc_normal_list', 'cc_normal_list_s']))
                    <div style="clear: both;"></div>
                    <?php $styled = $categoriesOptions['cat_display_type'] == 'cc_normal_list_s' ? ' styled' : ''; ?>

                    @if (isset($categories) and $categories->count() > 0)
                    <div class="col-xl-12">
                        <div class="list-categories-children{{ $styled }}">
                            <div class="row px-3">
                                @foreach ($categories as $key => $cols)
                                <div class="col-md-4 col-sm-4 {{ count($categories) == $key + 1 ? 'last-column' : '' }}">
                                    @foreach ($cols as $iCat)
                                    <?php
                                    $randomId = '-' . substr(uniqid(rand(), true), 5, 5);
                                    ?>

                                    <div class="cat-list">
                                        <h3 class="cat-title rounded">
                                            @if (in_array(config('settings.list.show_category_icon'), [2, 6, 7, 8]))
                                            <i class="{{ $iCat->icon_class ?? 'fas fa-check' }}"></i>&nbsp;
                                            @endif
                                            <a href="{{ \App\Helpers\UrlGen::category($iSubCat) }}">
                                                {{ $iCat->name }}
                                                @if (config('settings.list.count_categories_listings'))
                                                &nbsp;({{ $countPostsByCat->get($iCat->id)->total ?? 0 }})
                                                @endif
                                            </a>
                                            <span class="btn-cat-collapsed collapsed" data-bs-toggle="collapse" data-bs-target=".cat-id-{{ $iCat->id . $randomId }}" aria-expanded="false">
                                                <span class="icon-down-open-big"></span>
                                            </span>
                                        </h3>
                                        <ul class="cat-collapse collapse show cat-id-{{ $iCat->id . $randomId }} long-list-home">
                                            @if (isset($subCategories) and $subCategories->has($iCat->id))
                                            @foreach ($subCategories->get($iCat->id) as $iSubCat)
                                            <li>
                                                <a href="{{ \App\Helpers\UrlGen::category($iSubCat) }}">
                                                    {{ $iSubCat->name }}
                                                </a>
                                                @if (config('settings.list.count_categories_listings'))
                                                &nbsp;({{ $countPostsByCat->get($iSubCat->id)->total ?? 0 }})
                                                @endif
                                            </li>
                                            @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                    @endif
                    @else
                    <?php
                    $listTab = [
                        'c_border_list' => 'list-border',
                    ];
                    $rowPx = $categoriesOptions['cat_display_type'] ?? '';
                    $catListClass = isset($listTab[$categoriesOptions['cat_display_type']]) ? 'list ' . $listTab[$categoriesOptions['cat_display_type']] : 'list';
                    ?>
                    @if (isset($categories) and $categories->count() > 0)
                    <div class="col-xl-12">
                        <div class="list-categories">
                            <div class="row">
                                @foreach ($categories as $key => $items)
                                <ul class="cat-list {{ $catListClass }} col-md-4 {{ count($categories) == $key + 1 ? 'cat-list-border' : '' }}">
                                    @foreach ($items as $k => $cat)
                                    <li  onmouseover = "show_subcategories()">
                                        
                                        @if (in_array(config('settings.list.show_category_icon'), [2, 6, 7, 8]))
                                        <i class="{{ $cat->icon_class ?? 'fas fa-check' }}"></i>&nbsp;
                                        @endif
                                        <a href="{{ \App\Helpers\UrlGen::category($iSubCat) }}">
                                            {{ $cat->name }}
                                        </a>
                                        @if (config('settings.list.count_categories_listings'))
                                        &nbsp;({{ $countPostsByCat->get($cat->id)->total ?? 0 }})
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    @endif
                    <div class="col-12" id="subcat_id" style="position: absolute; right:-100%;Top:0px;z-index:1;height:100%;overflow-y: auto;">
                        <div class=" d-none" style="background-color:#467ad0" id="removecat">
                             <ul class="cat-list" id="showsubcategories" style="overflow-y: auto;">

                                </ul>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-9 d-none d-md-block" >
                   <div class="col-md-12">
                <div class="category-list make-grid noSideBar">

                    <div id="postsList" class="category-list-wrapper posts-wrapper row no-margin">
                        @foreach($widgetLatestPosts->posts as $post)
                        <div class="item-list">

                            <div class="row">
                                <div class="col-sm-2 col-12 no-padding photobox">
                                    <div class="add-image">
                                        <span class="photo-count">
                                            <i class="fa fa-camera"></i> 1
                                        </span>

                                        <a href="{{ \App\Helpers\UrlGen::post($post) }}">
                                            <img src="{{url('storage/'.json_decode($post->pictures[0])->filename)}}" style="height: 200px;" 
                                                class="lazyload thumbnail no-margin" alt="Da dwq">
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-7 col-12 add-desc-box">
                                    <div class="items-details">
                                        <h5 class="add-title">
                                            <a href="{{ \App\Helpers\UrlGen::post($post) }}">{{ Str::limit($post->title, 70) }}</a>
                                        </h5>

                                        {{-- <span class="info-row">
                                            <span class="date">
                                                <i class="far fa-clock"></i> {!! $post->created_at_formatted !!}
                                            </span>
                                            <span class="category">
                                                <i class="bi bi-folder"></i>&nbsp;
                                                <a href="{!! \App\Helpers\UrlGen::category($post->category->parent, null, $city ?? null) !!}" class="info-link">

                                                  {{ (!empty($post->category->parent)) ? json_decode($post->category->parent)->name : json_decode($post->category)->name }}
                                                    
                                                </a>&nbsp;»&nbsp;
                                                <a 
                                                 href="{!! \App\Helpers\UrlGen::category($post->category, null, $city ?? null) !!}"
                                                    class="info-link">
                                                    {{json_decode($post->category)->name}}
                                                </a>
                                            </span>
                                            <span class="item-location">
                                                <i class="bi bi-geo-alt"></i>&nbsp;
                                                <a href="{!! \App\Helpers\UrlGen::city($post->city, null, $cat ?? null) !!}"
                                                    class="info-link">
                                                   {{json_decode($post->city)->name}}
                                                </a>
                                            </span>
                                        </span> --}}

                                    </div>
                                </div>
                                <div class="col-sm-3 col-12 text-end price-box" style="white-space: nowrap;">
                                    <div class="row w-100">
                                        <div class="col-12 m-0 p-0 d-flex justify-content-end">
                                            <h2 class="item-price">
                                                {{$post->price?"$".$post->price:"Contact US"}}
                                            </h2>
                                        </div>
                                        <div class="col-12 m-0 p-0 d-flex justify-content-end">
                                           <a class="make-favorite" id="{{ $post->id }}" href="javascript:void(0)">
                                                                @if (auth()->check())
                                                                    @if (isset($post->savedByLoggedUser) && $post->savedByLoggedUser->count() > 0)
                                                                        <i class="fas fa-bookmark"
                                                                           data-bs-toggle="tooltip"
                                                                           title="{{ t('Remove favorite') }}"
                                                                        ></i>
                                                                    @else
                                                                        <i class="far fa-bookmark"
                                                                           data-bs-toggle="tooltip"
                                                                           title="{{ t('Save listing') }}"
                                                                        ></i>
                                                                    @endif
                                                                @else
                                                                    <i class="far fa-bookmark"
                                                                       data-bs-toggle="tooltip"
                                                                       title="{{ t('Save listing') }}"
                                                                    ></i>
                                                                @endif
                                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

              
            </div>
        </div>
    </div>
</div>
@endif

@section('before_scripts')
@parent

@if (isset($categoriesOptions) and
isset($categoriesOptions['max_sub_cats']) and
$categoriesOptions['max_sub_cats'] >= 0)

<script>
   

    var maxSubCats = {{(int) $categoriesOptions['max_sub_cats']}};

</script>
@endif
@endsection
<?php
if (!isset($cacheExpiration)) {
    $cacheExpiration = (int) config('settings.optimization.cache_expiration');
}
?>
@if (isset($posts) && $posts->count() > 0)
    <?php
    if (!isset($cats)) {
        $cats = collect([]);
    }
    
    foreach($posts as $key => $post):
        // Main Picture
        if ($post->pictures->count() > 0) {
            $postImg = $post->pictures->get(0)->filename;
        } else {
            $postImg = config('larapen.core.picture.default');
        }
    ?>

    <!-- <a href="{{ \App\Helpers\UrlGen::post($post) }}"> -->
        <div class="row g-0 mt-3" style="border: 2px solid #ddd;border-radius: 5px;">

           
                
                    <div class="col-2 nopadding">
                        <div style="position:relative;height:100%">


                            <img src="{{ url('storage/' . $postImg) }}" style="height: 100%;width: 100%">


                            <div style="position: absolute;bottom: 0px;">
                                <i class="fa fa-camera"></i> {{ $post->pictures->count() }}
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="d-flex flex-column mt-4 " style="margin-left: 1.5rem;">
                            <a href="{{ \App\Helpers\UrlGen::post($post) }}" class="text-dark">
                                <h2 style="   line-height: 0px; font-size: 18px;
                            font-weight: 700;">
                               {{ Str::limit($post->title, 40) }}
                                </h2>
                            </a>
                            <div class=""
                                style="margin-bottom: 12px;
                            color: #99b2bf;
                            width: 100%;">
                               {{ strip_tags(Str::limit($post->description, 70)) }}
                            </div>
                        </div>
                        <div class="d-flex" style="margin-left: 1.5rem;">
                            <div class="b-list-advert"
                                style="margin-bottom: 10px;background-color: #eef2f4;color: #303a4b;">
                                <i class="bi bi-folder"></i>&nbsp;
                                @if (isset($post->category->parent) && !empty($post->category->parent))
                                    <a href="{!! \App\Helpers\UrlGen::category($post->category->parent, null, $city ?? null) !!}" class="info-link">
                                        {{ $post->category->parent->name }}
                                    </a>&nbsp;&raquo;&nbsp;
                                @endif
                                <a href="{!! \App\Helpers\UrlGen::category($post->category, null, $city ?? null) !!}" class="info-link">
                                    {{ $post->category->name }}
                                </a>
                            </div>
                        </div>

                        <div class="d-flex align-item-end" style="margin-bottom: 12px;margin-left: 1.5rem;">
                            <i class="bi bi-geo-alt"></i>&nbsp;
                            <a href="{!! \App\Helpers\UrlGen::city($post->city, null, $cat ?? null) !!}" class="info-link">
                                {{ $post->city->name }}
                            </a>
                            {{ isset($post->distance) ? '- ' . round($post->distance, 2) . getDistanceUnit() : '' }}
                        </div>

                    </div>
                    <div class="col-2">
                        <div class="d-flex mt-4"
                            style="color: #3db83a;
                      
                        font-weight: 700;
                        white-space: nowrap;">

                            @if (isset($post->category->type))
                                @if (!in_array($post->category->type, ['not-salable']))
                                    @if (is_numeric($post->price) && $post->price > 0)
                                        {!! \App\Helpers\Number::money($post->price) !!}
                                    @elseif(is_numeric($post->price) && $post->price == 0)
                                        {!! t('free_as_price') !!}
                                    @else
                                        {!! t('Contact us') !!}
                                    @endif
                                @endif
                            @else
                                {!! t('Contact us') !!}
                            @endif

                        </div>
                    </div>
              
        </div>
    <!-- </a> -->
    <!-- <div class="item-list">
        @if ($post->featured == 1)
            @if (isset($post->latestPayment, $post->latestPayment->package) && !empty($post->latestPayment->package))
                @if ($post->latestPayment->package->ribbon != '')
<div class="cornerRibbons {{ $post->latestPayment->package->ribbon }}">
                        <a href="#"> {{ $post->latestPayment->package->short_name }}</a>
                    </div>
@endif
            @endif
        @endif

        <div class="row">
            <div class="col-sm-2 col-12 no-padding photobox">
                <div class="add-image">
                    <span class="photo-count">
                        <i class="fa fa-camera"></i> {{ $post->pictures->count() }}
                    </span>
                    <a href="{{ \App\Helpers\UrlGen::post($post) }}">
                        {!! imgTag($postImg, 'medium', ['class' => 'lazyload thumbnail no-margin', 'alt' => $post->title]) !!}
                    </a>
                </div>
            </div>

            <div class="col-sm-7 col-12 add-desc-box">
                <div class="items-details">
                    <h5 class="add-title">
                        <a href="{{ \App\Helpers\UrlGen::post($post) }}">{{ Str::limit($post->title, 70) }} </a>
                    </h5>
                            <span class="date">
                                    {!! transformDescription($post->description) !!}
                                 {{ Str::limit($post->description, 70) }}
                            </span>

                    <span class="info-row">
                        @if (config('settings.single.show_listing_types'))
                            @if (isset($post->postType) && !empty($post->postType))
<span class="add-type business-posts" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="{{ $post->postType->name }}">
                                    {{ strtoupper(mb_substr($post->postType->name, 0, 1)) }}
                                </span>&nbsp;
@endif
                        @endif
                        @if (!config('settings.list.hide_dates'))
<span class="date"{!! config('lang.direction') == 'rtl' ? ' dir="rtl"' : '' !!}>
                                <i class="far fa-clock"></i> {!! $post->created_at_formatted !!}
                            </span>
@endif
                        <span class="category"{!! config('lang.direction') == 'rtl' ? ' dir="rtl"' : '' !!}>
                            <i class="bi bi-folder"></i>&nbsp;
                            @if (isset($post->category->parent) && !empty($post->category->parent))
<a href="{!! \App\Helpers\UrlGen::category($post->category->parent, null, $city ?? null) !!}" class="info-link">
                                    {{ $post->category->parent->name }}
                                </a>&nbsp;&raquo;&nbsp;
@endif
                            <a href="{!! \App\Helpers\UrlGen::category($post->category, null, $city ?? null) !!}" class="info-link">
                                {{ $post->category->name }}
                            </a>
                        </span>
                        <span class="item-location"{!! config('lang.direction') == 'rtl' ? ' dir="rtl"' : '' !!}>
                            <i class="bi bi-geo-alt"></i>&nbsp;
                            <a href="{!! \App\Helpers\UrlGen::city($post->city, null, $cat ?? null) !!}" class="info-link">
                                {{ $post->city->name }}
                            </a>
                            {{ isset($post->distance) ? '- ' . round($post->distance, 2) . getDistanceUnit() : '' }}
                        </span>
                    </span>

                    @if (config('plugins.reviews.installed'))
                        @if (view()->exists('reviews::ratings-list'))
@include('reviews::ratings-list')
@endif
                    @endif
                </div>
            </div>

            <div class="col-sm-3 col-12 text-end price-box" style="white-space: nowrap;">
                <div class="row w-100">
                    <div class="col-12 m-0 p-0 d-flex justify-content-end">
                        <h2 class="item-price">
                            @if (isset($post->category->type))
                                @if (!in_array($post->category->type, ['not-salable']))
                                    @if (is_numeric($post->price) && $post->price > 0)
{!! \App\Helpers\Number::money($post->price) !!}
@elseif(is_numeric($post->price) && $post->price == 0)
{!! t('free_as_price') !!}
@else
{!! t('Contact us') !!}
@endif
                                @endif
@else
{!! t('Contact us') !!}
                            @endif
                        </h2>
                    </div>
                    <div class="col-12 m-0 p-0 d-flex justify-content-end">
                        @if (isset($post->latestPayment, $post->latestPayment->package) && !empty($post->latestPayment->package))
                            @if ($post->latestPayment->package->has_badge == 1)
<a class="btn btn-danger btn-sm make-favorite">
                                    <i class="fa fa-certificate"></i>
                                    <span>{{ $post->latestPayment->package->short_name }}</span>
                                </a>&nbsp;
@endif
                        @endif
                        @if (isset($post->savedByLoggedUser) && $post->savedByLoggedUser->count() > 0)
<a class="btn btn-success btn-sm make-favorite" id="{{ $post->id }}">
                                <i class="fas fa-bookmark"></i> <span>{{ t('Saved') }}</span>
                            </a>
@else
<a class="btn btn-default btn-sm make-favorite" id="{{ $post->id }}">
                                <i class="fas fa-bookmark"></i> <span>{{ t('Save') }}</span>
                            </a>
@endif
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <?php endforeach; ?>
@else
    <div class="p-4 w-100">
        {{ t('no_result_refine_your_search') }}
    </div>
@endif

@section('after_scripts')
    @parent
    <script>
        {{-- Favorites Translation --}}
        var lang = {
            labelSavePostSave: "{!! t('Save listing') !!}",
            labelSavePostRemove: "{!! t('Remove favorite') !!}",
            loginToSavePost: "{!! t('Please log in to save the Listings') !!}",
            loginToSaveSearch: "{!! t('Please log in to save your search') !!}",
            confirmationSavePost: "{!! t('Listing saved in favorites successfully') !!}",
            confirmationRemoveSavePost: "{!! t('Listing deleted from favorites successfully') !!}",
            confirmationSaveSearch: "{!! t('Search saved successfully') !!}",
            confirmationRemoveSaveSearch: "{!! t('Search deleted successfully') !!}"
        };
    </script>
@endsection

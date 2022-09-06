<?php
	$titleSlug = Str::slug($post->title);
	
	$price = null;
	if (!in_array($post->category->type, ['not-salable'])) {
		if (is_numeric($post->price) && $post->price > 0) {
			$price = \App\Helpers\Number::money($post->price);
		} else if (is_numeric($post->price) && $post->price == 0) {
			$price = t('free_as_price');
		} else {
			$price = t('Contact us');
		}
	}
	
	$picturesSliderPath = 'post.inc.pictures-slider.';
	$defaultPicturesSlider = 'swiper-horizontal';
	$picturesSlider = $picturesSliderPath . config('settings.single.pictures_slider', $defaultPicturesSlider);
?>
@if (view()->exists($picturesSlider))
	@includeFirst([config('larapen.core.customizedViewPath') . $picturesSlider, $picturesSlider])
@else
	<?php $defaultPicturesSlider = $picturesSliderPath . $defaultPicturesSlider; ?>
	@if (view()->exists($defaultPicturesSlider))
		@includeFirst([config('larapen.core.customizedViewPath') . $defaultPicturesSlider, $defaultPicturesSlider])
	@endif
@endif

@section('after_styles')
	@parent
	<link href="{{ url('assets/plugins/swipebox/1.5.2/css/swipebox.css') }}" rel="stylesheet"/>
	@if (config('lang.direction') == 'rtl')
		<style>
			html.swipebox-html {
				overflow: hidden !important;
			}
			html.swipebox-html #swipebox-overlay {
				direction: ltr;
			}
		</style>
	@endif
@endsection
@section('after_scripts')
	@parent
	<script src="{{ url('assets/plugins/swipebox/1.5.2/js/jquery.swipebox.js') }}"></script>
	<script>
		$(document).ready(function () {
			
			let documentBody = $(document.body);
			
			{{-- Navigate to the Swipebox next img when clicking on the current img --}}
			documentBody.on('click touchend', '#swipebox-slider .current img', function() {
				var clickedEl = $(this).get(0);
				if (clickedEl === undefined || clickedEl.nodeName === undefined) {
					return false;
				}
				
				if (strToLower(clickedEl.nodeName) == 'img') {
					$('#swipebox-next').click();
				}
				
				return false;
			});
			
			{{-- Closing the Swipebox modal on click on the background --}}
			documentBody.on('click touchend', '#swipebox-slider .current', function() {
				var clickedEl = $(this).get(0);
				if (clickedEl === undefined || clickedEl.nodeName === undefined) {
					return false;
				}
				
				if (strToLower(clickedEl.nodeName) != 'img') {
					$('#swipebox-close').click();
				}
			});
			
		});
		
		/**
		 * Get the swipebox items
		 *
		 * @param imgSrcArray
		 * @param title
		 * @returns {*}
		 */
		function formatImgSrcArrayForSwipebox(imgSrcArray, title = 'Title') {
			return map(imgSrcArray, function(imgSrc, index) {
				return { href:imgSrc, title:title };
			});
		}
		
		/**
		 * Get full size src of all pictures
		 *
		 * @param wrapperSelector
		 * @param currentSrc
		 * @returns {*[]}
		 */
		function getFullSizeSrcOfAllImg(wrapperSelector, currentSrc) {
			var allEl = document.querySelectorAll(wrapperSelector);
			
			var imgSrcArray = [getFullSizeSrc(currentSrc)];
			
			forEach(allEl, function(el, index) {
				if (el.src !== currentSrc) {
					imgSrcArray.push(getFullSizeSrc(el.src));
				}
			});
			
			return imgSrcArray;
		}
		
		/**
		 * Get the current picture's full size source
		 *
		 * @param imgSrc
		 * @returns {*}
		 */
		function getFullSizeSrc(imgSrc) {
			var regex = /thumb-([0-9]+)x([0-9]+)-/i;
			
			return imgSrc.replace(regex, '');
		}
	</script>
@endsection
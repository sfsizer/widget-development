jQuery(window).on('elementor/frontend/init', function () {

    elementorFrontend.hooks.addAction(
        'frontend/element_ready/post_slider.default',
        function ($scope, $) {

            let nextBtn = $scope.find('.next')[0]
            let prevBtn = $scope.find('.prev')[0]

            let slider = $scope.find('.slider')[0]
            let sliderList = slider.querySelector('.list')
            let thumbnail = slider.querySelector('.thumbnail')

            let thumbnailItems = thumbnail.querySelectorAll('.item')
            if (thumbnailItems.length > 0) {
                thumbnail.appendChild(thumbnailItems[0])
            }

            nextBtn.onclick = () => moveSlider('next')
            prevBtn.onclick = () => moveSlider('prev')

            function moveSlider(direction) {
                let sliderItems = sliderList.querySelectorAll('.item')
                let thumbnailItems = thumbnail.querySelectorAll('.item')

                if (direction === 'next') {
                    sliderList.appendChild(sliderItems[0])
                    thumbnail.appendChild(thumbnailItems[0])
                    slider.classList.add('next')
                } else {
                    sliderList.prepend(sliderItems[sliderItems.length - 1])
                    thumbnail.prepend(thumbnailItems[thumbnailItems.length - 1])
                    slider.classList.add('prev')
                }

                slider.addEventListener('animationend', function () {
                    slider.classList.remove('next')
                    slider.classList.remove('prev')
                }, { once: true })
            }
        }
    )

})

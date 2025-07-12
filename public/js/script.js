new Swiper('.story-wrapper', {
    loop: true,
    spaceBetween: 12,
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    breakpoints:{
        0: {
            slidesPerView: 3.5
        },
        1024: {
            slidesPerView: 6.5
        },

    }
  })

const stories = document.querySelectorAll('.story-link video');

    stories.forEach(video => {
        video.addEventListener('mouseenter', () => {
            video.play();
        });
        video.addEventListener('mouseleave', () => {
            video.pause();
            video.currentTime = 0; // Reset video to the beginning
        });
    });
const toggleButton = document.getElementById("toggle-button");
const hiddenContent = document.getElementById("hidden-content");

toggleButton.addEventListener("click", () => {
    if (hiddenContent.classList.contains("hidden")) {
    hiddenContent.classList.remove("hidden");
    toggleButton.textContent = "Thu gọn";
    } else {
    hiddenContent.classList.add("hidden");
    toggleButton.textContent = "Xem thêm";
    }
});

// Load story
// Select elements
const storyItems = document.querySelectorAll('.story-item');
const modal = document.getElementById('storyModal');
const modalVideo = modal.querySelector('video');
const modalTitle = modal.querySelector('.title'); // Sửa từ "modelTitle" thành ".title"
const closeModal = document.getElementById('closeModal');
const prevStory = document.getElementById('prevStory');
const nextStory = document.getElementById('nextStory');
let currentIndex = -1;

// Event listener for story items
storyItems.forEach((item, index) => {
    item.addEventListener('click', () => {
        currentIndex = index; // Ghi lại index hiện tại
        openModal(index);
    });
});
function openModal(index) {
    const item = storyItems[index];
    const videoSrc = item.getAttribute('data-video');
    const title = item.querySelector('.story-title');

    modalVideo.src = videoSrc;
    modalTitle.innerText = title.innerText;
    modal.style.display = 'flex';
}

// Navigate to previous video
prevStory.addEventListener('click', () => {
    currentIndex--;
    if (currentIndex >= 0) {
        openModal(currentIndex);
    }else{
        currentIndex=storyItems.length - 1;
        openModal(currentIndex);
    }
});

// Navigate to next video
nextStory.addEventListener('click', () => {
    currentIndex++;
    if (currentIndex > storyItems.length - 1) {
        openModal(0);
    }else{
        openModal(currentIndex);
    }
});

// Close modal
closeModal.addEventListener('click', () => {
    closeModalHandler();
});

modal.addEventListener('click', (e) => {
    if (e.target === modal) {
        closeModalHandler();
    }
});

// Close modal and reset video
function closeModalHandler() {
    modal.style.display = 'none';
    modalVideo.pause();
    modalVideo.src = '';
    modalTitle.innerText = '';
}


// Picture model
document.addEventListener('DOMContentLoaded', () => {
    const images = Array.from(document.querySelectorAll('.img img')); // Lấy tất cả ảnh
    const overlays = Array.from(document.querySelectorAll('.img .overlay')); // Lấy tất cả ảnh

    const modal = document.getElementById('pictureModal');
    const modalImage = modal.querySelector('img');
    const closeModal = document.getElementById('closeModalPicture');
    const prevButton = document.getElementById('prevPicture');
    const nextButton = document.getElementById('nextPicture');
    let currentImageIndex = 0; // Vị trí ảnh hiện tại


    // Hiển thị modal với ảnh tại vị trí index
    function openModal(index) {
        currentImageIndex = index;
        modalImage.src = images[currentImageIndex].src;
        modal.style.display = 'flex'; // Hiển thị modal
    }
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            hideModal();
        }
    });
    // Đóng modal
    function hideModal() {
        modal.style.display = 'none';
    }

    // Chuyển sang ảnh trước
    function showPrevImage() {
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        modalImage.src = images[currentImageIndex].src;
    }

    // Chuyển sang ảnh kế tiếp
    function showNextImage() {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        console.log(currentImageIndex);
        modalImage.src = images[currentImageIndex].src;
    }

    // Gắn sự kiện click vào mỗi ảnh
    images.forEach((img, index) => {
        img.addEventListener('click', () => openModal(index));
    });
    overlays.forEach(overlay => {
        const imgElement = overlay.closest('.img').querySelector('img');
        const index = images.indexOf(imgElement);
        overlay.addEventListener('click', () => openModal(index));
    });
    // Gắn sự kiện cho nút đóng modal
    closeModal.addEventListener('click', hideModal);

    // Gắn sự kiện cho nút điều hướng trái/phải
    prevButton.addEventListener('click', showPrevImage);
    nextButton.addEventListener('click', showNextImage);

    // Đóng modal khi nhấn phím ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') hideModal();
        if (e.key === 'ArrowLeft') showPrevImage();
        if (e.key === 'ArrowRight') showNextImage();
    });


    const feedbackImages = Array.from(document.querySelectorAll('.carousel-item img')); // Lấy tất cả ảnh
    const modalFeedback = document.getElementById('feedbackModal');
    const feedback = document.querySelector('.feedback .overlay');
    const modalImageFeedback = document.querySelector('#feedbackModal img');
    const closeModalFeedback = document.getElementById('closeModalFeedback');
    const prevButtonFeedback = document.getElementById('prevFeedback');
    const nextButtonFeedback = document.getElementById('nextFeedback');
    let currentImageIndexFeedback = 0; // Vị trí ảnh hiện tại

    // Hiển thị modal với ảnh tại vị trí index
    function openModalFeedback(index) {
        currentImageIndexFeedback = index;
        modalImageFeedback.src = feedbackImages[currentImageIndexFeedback].src;
        modalFeedback.style.display = 'flex'; // Hiển thị modal
    }
    modalFeedback.addEventListener('click', (e) => {
        if (e.target === modalFeedback) {
            hideModalFeedback();
        }
    });
    feedback.addEventListener('click', () => openModalFeedback(0));
    // Đóng modal
    function hideModalFeedback() {
        modalFeedback.style.display = 'none';
    }

    // Chuyển sang ảnh trước
    function showPrevImageFeedback() {
        currentImageIndexFeedback = (currentImageIndexFeedback - 1 + feedbackImages.length) % feedbackImages.length;
        modalImageFeedback.src = feedbackImages[currentImageIndexFeedback].src;
    }

    // Chuyển sang ảnh kế tiếp
    function showNextImageFeedback() {
        currentImageIndexFeedback = (currentImageIndexFeedback + 1) % feedbackImages.length;
        modalImageFeedback.src = feedbackImages[currentImageIndexFeedback].src;
    }

    // Gắn sự kiện click vào mỗi ảnh
    feedbackImages.forEach((img, index) => {
        img.addEventListener('click', () => openModalFeedback(index));
    });

    // Gắn sự kiện cho nút đóng modal
    closeModalFeedback.addEventListener('click', hideModalFeedback);

    // Gắn sự kiện cho nút điều hướng trái/phải
    prevButtonFeedback.addEventListener('click', showPrevImageFeedback);
    nextButtonFeedback.addEventListener('click', showNextImageFeedback);

    // Đóng modal khi nhấn phím ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') hideModalFeedback();
        if (e.key === 'ArrowLeft') showPrevImageFeedback();
        if (e.key === 'ArrowRight') showNextImageFeedback();
    });
});

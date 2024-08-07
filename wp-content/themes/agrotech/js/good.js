var currentSelectedImageIdx = 0;
var currentSelectedImage = null;
var isFullscreen = false;
const imagesSrcArray = at_product_data.images_src_array;
const primaryImage = document.getElementById("primary-image");
var fullscreenImage = null;

function getImageBySrc(src) {
  return document.querySelector(`img[src='${src}']`);
}

function onLoad() {
  currentSelectedImage = getImageBySrc(imagesSrcArray[currentSelectedImageIdx]);
  currentSelectedImage.classList.add('selected');
}

function selectNewImageByIndex(index) {
  currentSelectedImageIdx = index;
  newImageSrc = imagesSrcArray[index];

  if (isFullscreen) {
    fullscreenImage.src = newImageSrc;
  } else {
    primaryImage.src = newImageSrc;
    currentSelectedImage.classList.remove('selected');
    currentSelectedImage = getImageBySrc(newImageSrc);
    currentSelectedImage.classList.add('selected');
  }
}

function onClickGalleryImage(target) {
  const targetImageSrc = target.src;
  primaryImage.src = targetImageSrc;

  currentSelectedImage.classList.remove('selected');
  currentSelectedImage = target;
  currentSelectedImage.classList.add('selected');
  currentSelectedImageIdx = imagesSrcArray.findIndex((item) => item === targetImageSrc);
}

function onClickNextImage() {
  var newIndex = currentSelectedImageIdx + 1;
  if (newIndex >= imagesSrcArray.length) {
    newIndex = 0;
  }

  selectNewImageByIndex(newIndex);
}

function onClickPrevImage() {
  var newIndex = currentSelectedImageIdx - 1;
  if (newIndex < 0) {
    newIndex = imagesSrcArray.length - 1;
  }

  selectNewImageByIndex(newIndex);
}

function openFullscreenPreview() {
  isFullscreen = true;
  const fullscreenContainer = document.getElementById("fullscreen-preview");
  fullscreenContainer.style.display = 'flex';

  fullscreenImage = document.getElementById("fullscreen-image-preview");
  fullscreenImage.src = currentSelectedImage.src;
}

function closeFullscreenPreview() {
  isFullscreen = false;
  selectNewImageByIndex(currentSelectedImageIdx);
  const fullscreenContainer = document.getElementById("fullscreen-preview");
  fullscreenContainer.style.display = 'none';
}

onLoad();

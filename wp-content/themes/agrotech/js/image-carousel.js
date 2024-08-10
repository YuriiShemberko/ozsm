var container = null;
var fullscreenContainer = null;

var currentSelectedImageIdx = 0;
var currentSelectedImage = null;

var isFullscreen = false;
const imagesSrcArray = at_img_data.img_srcs;

var fullscreenImage = null;

function getContainer() {
  return isFullscreen ? fullscreenContainer : container;
}

function getPrimaryImage() {
  return getContainer().querySelector("#primary-image");
}

function getImageBySrc(src) {
  return getContainer().querySelector(`div.secondary-image-wrapper img[src='${src}']`);
}

function onLoad() {
  container = document.getElementById("carousel-content-container");
  currentSelectedImage = getImageBySrc(imagesSrcArray[currentSelectedImageIdx]);
  currentSelectedImage.parentNode.classList.add("selected");
}

function selectNewImageByIndex(index) {
  currentSelectedImageIdx = index;
  newImageSrc = imagesSrcArray[index];
  getPrimaryImage().src = newImageSrc;
  currentSelectedImage.parentNode.classList.remove("selected");
  currentSelectedImage = getImageBySrc(newImageSrc);
  currentSelectedImage.parentNode.classList.add("selected");
}

function onClickGalleryImage(target) {
  const targetImage = target.querySelector('img');
  const targetImageSrc = decodeURI(targetImage.src);
  getPrimaryImage().src = targetImageSrc;

  currentSelectedImage.parentNode.classList.remove("selected");
  currentSelectedImage = targetImage;
  currentSelectedImage.parentNode.classList.add("selected");
  currentSelectedImageIdx = imagesSrcArray.findIndex((item) => item === targetImageSrc);
  currentSelectedImage.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' });
}

function onClickNextImage() {
  var newIndex = currentSelectedImageIdx + 1;
  if (newIndex >= imagesSrcArray.length) {
    newIndex = 0;
  }

  selectNewImageByIndex(newIndex);
  currentSelectedImage.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' });
}

function onClickPrevImage() {
  var newIndex = currentSelectedImageIdx - 1;
  if (newIndex < 0) {
    newIndex = imagesSrcArray.length - 1;
  }

  selectNewImageByIndex(newIndex);
  currentSelectedImage.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' });
}

function openFullscreenPreview() {

  if (isFullscreen) {
    return;
  }

  const page = document.getElementById("page");
  const carousel = document.getElementById("carousel-content-container").cloneNode(true);

  fullscreenContainer = document.createElement("div");
  const wrapper = document.createElement("div");

  fullscreenContainer.classList.add("carousel-fullscreen-container");
  wrapper.classList.add("carousel-fullscreen-wrapper");

  wrapper.appendChild(carousel);
  fullscreenContainer.appendChild(wrapper);

  const closeBtn = document.getElementById("fullscreen-close-btn").cloneNode(true);
  closeBtn.style.display = "block";

  fullscreenContainer.appendChild(closeBtn);

  page.appendChild(fullscreenContainer);
  isFullscreen = true;

  currentSelectedImage.parentNode.classList.remove("selected");
  currentSelectedImage = getImageBySrc(imagesSrcArray[currentSelectedImageIdx]);
  selectNewImageByIndex(currentSelectedImageIdx);
}

function closeFullscreenPreview() {
  const page = document.getElementById("page");
  page.removeChild(fullscreenContainer);

  isFullscreen = false;

  currentSelectedImage = getImageBySrc(imagesSrcArray[currentSelectedImageIdx]);
  selectNewImageByIndex(currentSelectedImageIdx);
}

onLoad();

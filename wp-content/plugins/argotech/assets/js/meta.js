function at_onUploadClick(e) {

  const imagesListInput = document.getElementById('at_good_images_input');
  const existingImagesList = imagesListInput.value;

  // do not link an uploaded attachment to a specific post
  wp.media.model.settings.post.id = 0;

  const imageUploader = wp.media({
    title: 'Оберіть зображення',
    library: { type: 'image' },
    button: { text: 'Обрати' },
    multiple: true,
  });

  imageUploader.on('open', () => {
    const selection = imageUploader.state().get('selection');
    const ids = existingImagesList ? existingImagesList.split(',') : [];
    ids.forEach((id) => {
      const attachment = wp.media.attachment(id);
      attachment.fetch();
      selection.add( attachment ? [ attachment ] : [] );
    });
  });

  imageUploader.on('select', () => {
    const ids = imageUploader.state().get('selection').map((item) => item['id']);
    const idsValue = ids.join(',');
    imagesListInput.setAttribute('value', idsValue);
  });

  imageUploader.open();
}

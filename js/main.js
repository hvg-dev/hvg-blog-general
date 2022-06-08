$(function() {
    $('img').on("error", function() {
      $(this).attr('src', templateURL + '/assets/images/default_empty_image.jpg');
      $(this).attr('srcset', templateURL + '/assets/images/default_empty_image.jpg');
    });
    const brandColor = getComputedStyle(document.documentElement).getPropertyValue('--base-primary-color');
    const inverseColor = getTextContrastColor(brandColor.replaceAll(' ', ''));
    document.documentElement.style.setProperty('--base-hover-background-color', inverseColor);
  });

  function getTextContrastColor (hex) {
    const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex)
    const rgb = result
      ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
      }
      : null

    const getColor = (rgb.r * 299 + rgb.g * 587 + rgb.b * 114) / 1000 > 125 ? '#343434' : '#ffffff'
    return getColor
  }


function setTabIcon(iconClass){
  var link = document.createElement('link');
  link.rel = 'icon';
  link.type = 'image/x-icon';
  link.href = 'data:image/svg+xml,' + encodeURIComponent('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><text x="10" y="70" font-family="Arial" font-size="70" font-weight="bold" fill="white">' + iconClass + '</text></svg>');
  document.head.appendChild(link);
}
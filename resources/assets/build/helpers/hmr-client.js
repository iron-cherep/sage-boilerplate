/* eslint-disable import/no-extraneous-dependencies */
/* eslint-disable import/no-unresolved */
const hotMiddlewareScript = require('webpack-hot-middleware/client?noInfo=true&timeout=20000&reload=true');

hotMiddlewareScript.subscribe((event) => {
  if (event.action === 'reload') {
    window.location.reload();
  }
});

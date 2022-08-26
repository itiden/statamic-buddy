const mix = require("laravel-mix");
const path = require("path");

mix
  .js("resources/js/index.js", "dist/js")
  .vue();
  // .copyDirectory(
  //   "dist/js",
  //   path.resolve(
  //     "../",
  //     "../",
  //     "../",
  //     "public",
  //     "vendor",
  //     "statamic-buddy",
  //     "js"
  //   )
  // );

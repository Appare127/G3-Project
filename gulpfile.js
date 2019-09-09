var gulp = require('gulp');
// var autoprefixer = require('gulp-autoprefixer');
var cleanCSS = require('gulp-clean-css');
var fileinclude = require('gulp-file-include');
var browserSync = require('browser-sync').create();
var  reload = browserSync.reload;
var sass = require('gulp-sass');

//把js資料匣打包到dest(自動會生成dest資料匣)
gulp.task('concat', function () {
  //do sometime
  gulp.src('./dev/js/*.js').pipe(gulp.dest('./dest/js'));
  gulp.src('./dev/js/**/*.js').pipe(gulp.dest('./dest/js'));
});


//html template 建立模板

gulp.task('template', function () {
  gulp.src(['dev/*.html','dev/*.php','dev/**/*.php'])
      .pipe(fileinclude({
          prefix: '@@',
          basepath: '@file'
      }))
      .pipe(gulp.dest('dest'));
});

//sass轉
gulp.task('sass', function () {
  return gulp.src('./dev/sass/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./dest/css'));
});

//img轉
gulp.task('moveImg', function () {
  gulp.src(["dev/img/*", "dev/img/*/*"])
      .pipe(gulp.dest('dest/img'))
});

//php轉
gulp.task('php', function () {
  gulp.src('./dev/php/*',).pipe(gulp.dest('./dest/php'));
  gulp.src('./dev/php/**/*').pipe(gulp.dest('./dest/php'));
});

//css轉
gulp.task('css', function () {
  gulp.src('./dev/plugin/*',).pipe(gulp.dest('./dest/css'));
  gulp.src('./dev/plugin/**/*').pipe(gulp.dest('./dest/css'));
});



//連接瀏覽器(liveserver)
gulp.task('default', function () {

  browserSync.init({
      server: {
          //根目錄
          baseDir: "./dest",
          index: "shop.html"

      }
  });

  // "./"表示是根目錄底下的 最好都加


  // gulp.watch(["dev/*.html" , "dev/**/*.html",'dev/*.php','dev/**/*.php'] , ['template']).on('change', reload);
  gulp.watch(["./dev/js/*.js","./dev/js/**/*.js"] ,['concat'] ).on('change', reload);
  gulp.watch(["./dev/sass/*.scss","./dev/sass/**/*.scss"], ['sass']).on('change', reload);
  gulp.watch(["dev/img/*/*"], ["moveImg"]).on('change', reload);
  // gulp.watch(["dev/php/*"], ["php"]).on('change', reload);

  gulp.watch(["dev/*.html" , "dev/**/*.html" , 'dev/*.php','dev/**/*.php'] , ['template','sass','concat',"moveImg","php","css"]).on('load', reload);

});


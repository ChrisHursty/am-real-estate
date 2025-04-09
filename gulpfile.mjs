// gulpfile.mjs
import gulp from 'gulp';
import sassModule from 'gulp-sass';
import * as sassCompiler from 'sass';
import browserSync from 'browser-sync';
import autoprefixer from 'gulp-autoprefixer';
import cleanCSS from 'gulp-clean-css';
import rename from 'gulp-rename';
import changed from 'gulp-changed';
import uglify from 'gulp-uglify';
import imagemin from 'gulp-imagemin';
import zip from 'gulp-zip';

const { src, dest, watch, series, parallel } = gulp;
const sass = sassModule(sassCompiler);
const browserSyncInstance = browserSync.create();

function compileSass() {
    return src('scss/**/*.scss')
        .pipe(changed('css'))
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({ overrideBrowserslist: ['last 2 versions'] }))
        .pipe(dest('css'))
        .pipe(cleanCSS({ compatibility: 'ie8' }))
        .pipe(rename({ suffix: '.min' }))
        .pipe(dest('dist/css'))
        .pipe(browserSyncInstance.stream()); // Ensure stream comes after minification
}

function minifyJs() {
    return src('js/**/*.js')
        .pipe(uglify())
        .pipe(rename({ suffix: '.min' }))
        .pipe(dest('dist/js'))
        .pipe(browserSyncInstance.stream()); // Add stream to JS task
}

function serve() {
    browserSyncInstance.init({ proxy: "http://localhost:10008/" });

    // Watch SCSS files for changes, compile and minify them
    watch('scss/**/*.scss', compileSass);

    // Watch JS files for changes and minify them
    watch('js/**/*.js', minifyJs);

    // Reload the browser when PHP files change
    watch('*.php').on('change', browserSyncInstance.reload);
}

function optimizeImages() {
    return src('images/**/*')
        .pipe(imagemin())
        .pipe(dest('dist/images'));
}

function zipProject() {
    return src(['**/*', '!node_modules/**/*', '!dist/**/*', '!*.zip'])
        .pipe(zip('custom-wp-theme.zip'))
        .pipe(dest('../'));
}

function buildProd(done) {
    series(compileSass, minifyJs, optimizeImages, zipProject)(done);
}

export default serve;
export const sassTask = compileSass;
export const jsTask = minifyJs;
export const imgTask = optimizeImages;
export const zipTask = zipProject;
export const build = buildProd;

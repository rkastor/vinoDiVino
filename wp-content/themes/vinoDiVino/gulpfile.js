/******************************Пути*************************************/
var npmDir = 'node_modules',
    main_src = 'assets',
    html_src = 'html-templates',
    css_src = main_src + '/styles',
    js_src = main_src + '/scripts',
    img_src = main_src + '/images',
    font_src = main_src + '/fonts',
    svg_src = main_src + '/svg',
    sassGen = css_src + '/generated',

    main_dist = './dist',
    html_dist = main_dist,
    css_dist = main_dist + '/css',
    js_dist = main_dist + '/js',
    img_dist = main_dist + '/images',
    font_dist = main_dist + '/fonts',
    svg_dist = main_dist + '/svg';

/**************************Зависимости*************************************/
var gulp = require('gulp'),
    sass = require('gulp-sass'),
    browserSync = require('browser-sync').create(),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    cssnano = require('gulp-cssnano'),
    rename = require('gulp-rename'),
    del = require('del'),
    imagemin = require('gulp-imagemin'),
    pngquant = require('imagemin-pngquant'),
    cache = require('gulp-cache'),
    // autoprefixer   = require('gulp-autoprefixer'),
    autoprefixer = require('autoprefixer'),
    htmlmin = require('gulp-htmlmin'),
    nunjucksRender = require('gulp-nunjucks-render'),
    wait = require('gulp-wait'),
    postcss = require('gulp-postcss'),
    sourcemaps = require('gulp-sourcemaps'),
    mqpacker = require('css-mqpacker'),
    csso = require("gulp-csso"),
    pump = require("pump"),
    svgmin = require('gulp-svgmin'),
    changed = require('gulp-changed'),
    svgStore = require('gulp-svgstore'),
    cheerio = require('gulp-cheerio'),
    through2 = require('through2'),
    consolidate = require('gulp-consolidate'),
    svgSprite = require("gulp-svg-sprite"),
    path = require('path'),
    glob = require('glob'),
    size = require('gulp-size'),
    sort = require('gulp-sort'),
    plumber = require('gulp-plumber');


var shortConfig = {};
['border', 'borderRadius', 'color', 'fontSize', 'position', 'size', 'spacing'].forEach((val) => {
    shortConfig[val] = { skip: '_' };
});

/**************************PostCss functions*************************************/
function isMax(mq) {
    return /max-width/.test(mq);
}

function isMin(mq) {
    return /min-width/.test(mq);
}

function sortMediaQueries(a, b) {
    A = a.replace(/\D/g, '');
    B = b.replace(/\D/g, '');

    if (isMax(a) && isMax(b)) {
        return B - A;
    } else if (isMin(a) && isMin(b)) {
        return A - B;
    } else if (isMax(a) && isMin(b)) {
        return 1;
    } else if (isMin(a) && isMax(b)) {
        return -1;
    }

    return 1;
}

var AUTOPREFIXER = [

    '> 1%',
    'ie >= 8',
    'edge >= 15',
    'ie_mob >= 10',
    'ff >= 45',
    'chrome >= 45',
    'safari >= 7',
    'opera >= 23',
    'ios >= 7',
    'android >= 4',
    'bb >= 10'

];

var processors = [
    autoprefixer({
        browsers: AUTOPREFIXER,
        cascade: false,
        grid: true
    }),
    require('lost'),
    mqpacker({
        sort: sortMediaQueries
    }),
    require('rucksack-css')({
        autoprefixer: false
    }),
    require('postcss-short')(shortConfig),
    csso
];

/**************************Компиляция SASS*************************************/
gulp.task('sass', function () {
    return gulp.src(css_src + '/**/*.{sass,scss}')
        // .pipe(wait(500))
        .pipe(plumber())
        .pipe(sass())
        .pipe(postcss(processors))
        .pipe(sourcemaps.init())
        // .pipe(sourcemaps.write('./'))
        .pipe(concat('style.css'))
        .pipe(gulp.dest(css_dist))
        .pipe(browserSync.stream());
});

/**************************Сжатие CSS*******************************************/
gulp.task('css-main', ['sass'], function () {
    return gulp.src(css_dist + '/style.css')
        .pipe(cssnano())
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest(css_dist));
});

gulp.task("css-libs", function () {
    return gulp.src([
        npmDir + '/reset-css/reset.css',
        npmDir + '/flexboxgrid/css/flexboxgrid.min.css',
        npmDir + '/swiper/dist/css/swiper.css',
        npmDir + '/aos/dist/aos.css',
    ])
        .pipe(concat("vendor.min.css"))
        .pipe(gulp.dest(css_dist));
});

/**************************Vendor JS*******************************************/
gulp.task('scripts_libs', function () {
    return gulp.src([
        npmDir + '/jquery/dist/jquery.min.js',
        npmDir + '/swiper/dist/js/swiper.min.js',
        npmDir + '/aos/dist/aos.js',
        main_src + '/mask.js',
    ])
        .pipe(plumber())
        .pipe(concat('libs.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(js_dist));
});
/**************************Main JS*******************************************/
gulp.task('scripts_main', function () {
    return gulp.src(js_src + '/*.js')
        // .pipe(wait(500))
        .pipe(plumber())
        .pipe(sort({
            comparator: function (file1, file2) {
                if (file1.path.indexOf('build') > -1) {
                    return 1;
                }
                if (file2.path.indexOf('build') > -1) {
                    return -1;
                }
                return 0;
            }
        }))
        .pipe(concat('main.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(js_dist))
        .pipe(browserSync.reload({ stream: true }));
});

/**************************Browser Sync****************************************/
gulp.task('browser-sync', function () {
    browserSync.init({
        // server: {
        //     baseDir: main_dist
        // },
        notify: true,
        watchEvents : [ 'change', 'add', 'unlink', 'addDir', 'unlinkDir' ],
        files: [
            {
                match: [
                    // html_src + '/**',
                    css_src + '/**',
                    js_src + '/**',
                    img_src + '/**',
                ],
                fn:    function (event, file) {
                    this.reload()
                },
            },
        ],
    });
});


gulp.task('clean', function () {
    return del.sync(main_dist);
});

gulp.task('cleare', function () {
    return cache.clearAll();
});

/**************************Уменьшение изображений******************************/
gulp.task('img', function () {
    return gulp.src(img_src + '/**/*')
        // .pipe(cache(imagemin({
        //     interlaced: true,
        //     progressive: true,
        //     svgoPlugins: [{removeViewBox: false}],
        //     use: [pngquant()]
        // })))
        // .pipe(del.sync(img_dist))
        .pipe(gulp.dest(img_dist))
        .pipe(browserSync.reload({ stream: true }));

});

/************************************Replase fonts******************************/
gulp.task('fonts', function () {
    return gulp.src(font_src + '/**/*')
        .pipe(gulp.dest(font_dist))
        .pipe(browserSync.reload({ stream: true }));
});

gulp.task('svgo', function () {
    return gulp
        .src(svg_src + '/**/*.svg')
        .pipe(plumber())
        .pipe(changed(svg_dist))
        .pipe(svgmin({
            js2svg: {
                pretty: true
            },
            plugins: [{
                removeDesc: true
            }, {
                cleanupIDs: true
            }, {
                mergePaths: false
            }]
        }))
        .pipe(gulp.dest(svg_dist));
});

/**************************************Сжатие html******************************/
gulp.task('minify_html', function () {
    return gulp.src(html_src + '/*.html')
        .pipe(plumber())
        .pipe(htmlmin({ collapseWhitespace: true }))
        .pipe(gulp.dest(main_dist));
});
/***********************************template html******************************/
gulp.task('nunjucks-render', function () {
    return gulp.src(html_src + "/*.html")
        .pipe(plumber())
        .pipe(nunjucksRender({
            path: html_src // String or Array
        }))
        .pipe(gulp.dest(html_dist))
});

/*******************************Обработчик ошибок******************************/
function log(error) {
    console.log([
        '',
        "----------ERROR MESSAGE START----------".bold.red.underline,
        ("[" + error.name + " in " + error.plugin + "]").red.bold.inverse,
        error.message,
        "----------ERROR MESSAGE END----------".bold.red.underline,
        ''
    ].join('\n'));
    this.end();
}


/*************************************WATCH************************************/
gulp.task('watch', ['browser-sync', 'sass', 'img', 'css-libs', 'scripts_main', 'scripts_libs', 'fonts', 'svgo', 'css-main'], function() {

    gulp.watch([css_src + '/**/*.{sass,scss}'], ['sass']);
    gulp.watch([img_src + "/**/*"], ['img']).on("add addDir", browserSync.reload);
    gulp.watch([js_src + '/**/*.js'], ['scripts_main']).on("change add", browserSync.stream);
    gulp.watch([font_src], ['fonts']).on("change create", browserSync.reload);
    gulp.watch([svg_src + '/**/*.svg'], ['svgo']).on("change", browserSync.reload);
    // gulp.watch([html_src + "/**/*"], ['nunjucks-render']).on("change", browserSync.reload);
});

gulp.task('default', ['watch']);

/*************************************СБОРКА***********************************/
gulp.task('build', ['clean', 'img', 'scripts_main', 'scripts_libs', 'nunjucks-render', 'css-libs', 'css-main', 'fonts', 'svgo']);
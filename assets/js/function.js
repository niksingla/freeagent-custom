'use strict';
const jwsNow = Date.now || function () {
  return new Date().getTime();
};
window.jwsThrottle = function (func, wait, options) {
  var timeout, context, args, result;
  var previous = 0;
  if (!options) options = {};
  var later = function () {
    previous = options.leading === false ? 0 : jwsNow();
    timeout = null;
    result = func.apply(context, args);
    if (!timeout) context = args = null;
  };
  var throttled = function () {
    var now = jwsNow();
    if (!previous && options.leading === false) previous = now;
    var remaining = wait - (now - previous);
    context = this;
    args = arguments;
    if (remaining <= 0 || remaining > wait) {
      if (timeout) {
        clearTimeout(timeout);
        timeout = null;
      }
      previous = now;
      result = func.apply(context, args);
      if (!timeout) context = args = null;
    } else if (!timeout && options.trailing !== false) {
      timeout = setTimeout(later, remaining);
    }
    return result;
  };
  throttled.cancel = function () {
    clearTimeout(timeout);
    previous = 0;
    timeout = context = args = null;
  };
  return throttled;
};
const restArguments = function (func, startIndex) {
  startIndex = startIndex == null ? func.length - 1 : +startIndex;
  return function () {
    var length = Math.max(arguments.length - startIndex, 0),
      rest = Array(length),
      index = 0;
    for (; index < length; index++) {
      rest[index] = arguments[index + startIndex];
    }
    switch (startIndex) {
      case 0:
        return func.call(this, rest);
      case 1:
        return func.call(this, arguments[0], rest);
      case 2:
        return func.call(this, arguments[0], arguments[1], rest);
    }
    var args = Array(startIndex + 1);
    for (index = 0; index < startIndex; index++) {
      args[index] = arguments[index];
    }
    args[startIndex] = rest;
    return func.apply(this, args);
  };
};
const jwsDelay = restArguments(function (func, wait, args) {
  return setTimeout(function () {
    return func.apply(null, args);
  }, wait);
});
window.jwsDebounce = function (func, wait, immediate) {
  var timeout, result;
  var later = function (context, args) {
    timeout = null;
    if (args) result = func.apply(context, args);
  };
  var debounced = restArguments(function (args) {
    if (timeout) clearTimeout(timeout);
    if (immediate) {
      var callNow = !timeout;
      timeout = setTimeout(later, wait);
      if (callNow) result = func.apply(this, args);
    } else {
      timeout = jwsDelay(later, wait, this, args);
    }
    return result;
  });
  debounced.cancel = function () {
    clearTimeout(timeout);
    timeout = null;
  };
  return debounced;
};

window.jwsSlugify = function (str) {
  return String(str).normalize('NFKD').replace(/[\u0300-\u036f]/g, '').trim().toLowerCase().replace(/[^a-z0-9 -]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
};

window.jwsCheckedFonts = [];

window.jwsIsMobile = function () {
  return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 0 || navigator.platform === 'iPad';
};

window.jwsElements = $ => { 
    
 window.$jwsContents = $('#main');
 window.$jwsBody = $('body');
    
}

jwsElements(jQuery);

(function ($) {
  'use strict';

  const pluginName = 'jwsSplitText';
  let defaults = {
    type: "words",
    forceApply: false
  };
  class Plugin {
    constructor(element, options) {
      this._defaults = defaults;
      this._name = pluginName;
      this.options = {
        ...defaults,
        ...options
      };
      this.splittedTextList = {
        lines: [],
        words: [],
        chars: []
      };
      this.splitTextInstance = null;
      this.isRTL = $('html').attr('dir') === 'rtl';
      this.element = element;
      this.$element = $(element);
      this.prevWindowWidth = window.innerWidth;
      this.fontInfo = {};
      this.splitDonePormise = new Promise(resolve => {
        this.$element.on('lqdsplittext', resolve.bind(this, this));
      });
      if (!this.options.forceApply) {
        new IntersectionObserver(([entry], observer) => {
          if (entry.isIntersecting) {
            observer.disconnect();
            this.init();
          }
        }, {
          rootMargin: '20%'
        }).observe(this.element);
      } else {
        this.init();
      }
    }
    async init() {
      await this._measure();
      await this._onFontsLoad();
      this._windowResize();
    }
    _measure() {
      return fastdomPromised.measure(() => {
        const styles = getComputedStyle(this.element);
        this.fontInfo.elementFontFamily = styles.fontFamily.replace(/"/g, '').replace(/'/g, '').split(',')[0];
        this.fontInfo.elementFontWeight = styles.fontWeight;
        this.fontInfo.elementFontStyle = styles.fontStyle;
        this.fontInfo.fontFamilySlug = window.jwsSlugify(this.fontInfo.elementFontFamily);
      });
    }
    _onFontsLoad() {
      return fastdomPromised.measure(() => {
        if (window.jwsCheckedFonts.find(ff => ff === this.fontInfo.fontFamilySlug)) {
          return this._doSplit();
        }
        const font = new FontFaceObserver(this.fontInfo.elementFontFamily, {
          weight: this.fontInfo.elementFontWeight,
          style: this.fontInfo.elementFontStyle
        });
        return font.load().finally(() => {
          window.jwsCheckedFonts.push(this.fontInfo.fontFamilySlug);
          this._doSplit();
        });
      });
    }
    getSplitTypeArray() {
      const {
        type
      } = this.options;
      const splitTypeArray = type.split(',').map(item => item.replace(' ', ''));
      if (!this.isRTL) {
        return splitTypeArray;
      } else {
        return splitTypeArray.filter(type => type !== 'chars');
      }
    }
    async _doSplit() {
      await this._split();
      await this._unitsOp();
      await this._onSplittingDone();
    }
    _split() {
      const splitType = this.getSplitTypeArray();
      const fancyHeadingInner = this.element.classList.contains('ld-fh-txt') && this.element.querySelector('.ld-fh-txt-inner') != null;
      const el = fancyHeadingInner ? this.element.querySelector('.ld-fh-txt-inner') : this.element;
      let splittedText;
      return fastdomPromised.mutate(() => {
      
        splittedText = new SplitText(el, {
          type: splitType,
          charsClass: 'split-unit jws-chars',
          linesClass: 'split-unit jws-lines',
          wordsClass: 'split-unit jws-words'
        });
        splitType.forEach(type => {
          splittedText[type].forEach(element => {
            this.splittedTextList[type].push(element);
          });
        });
        this.element.classList.add('split-text-applied');
        this.splitTextInstance = splittedText;
      });
    }
    _unitsOp() {
      return fastdomPromised.mutate(() => {
        for (const [splitType, splittedTextArray] of Object.entries(this.splittedTextList)) {
          if (splittedTextArray && splittedTextArray.length > 0) {
            splittedTextArray.forEach((splitElement, i) => {
              splitElement.style.setProperty(`--${splitType}-index`, i);
              splitElement.style.setProperty(`--${splitType}-last-index`, splittedTextArray.length - 1 - i);
              $(splitElement).wrapInner(`<span class="split-inner" />`);
            });
          }
          ;
        }
        ;
      });
    }
    _onSplittingDone() {
      return fastdomPromised.mutate(() => {
        this.element.dispatchEvent(new CustomEvent('lqdsplittext'));
      });
    }
    _windowResize() {
      $(window).on('resize.jwsSplitText', this._onWindowResize.bind(this));
    }
    _onWindowResize() {
      if (this.prevWindowWidth === window.innerWidth) return;
      if (this.splitTextInstance) {
        this.splitTextInstance.revert();
        this.element.classList.remove('split-text-applied');
      }
      this._onAfterWindowResize();
      this.prevWindowWidth = window.innerWidth;
    }
    _onAfterWindowResize() {
      this._doSplit();
      this._onSplittingDone();
      this.$element.find('.split-unit').addClass('jws-unit-animation-done');
    }
    destroy() {
      $(window).off('resize.jwsSplitText');
    }
  }
  $.fn[pluginName] = function (options) {
    return this.each(function () {
      const pluginOptions = {
        ...$(this).data('split-options'),
        ...options
      };
      if (!$.data(this, "plugin_" + pluginName)) {
        $.data(this, "plugin_" + pluginName, new Plugin(this, pluginOptions));
      }
    });
  };
})(jQuery);

jQuery(document).ready(function ($) {
const $elements = $('[data-split-text]').filter((i, el) => {
    const $el = $(el);
    const isCustomAnimation = el.hasAttribute('data-custom-animations');
    const hasCustomAnimationParent = $el.closest('[data-custom-animations]').length;
    const hasAccordionParent = $el.closest('.accordion-content').length;
    const hasTabParent = $el.closest('.jws-tabs-pane').length;
    const webglSlideshowParent = $el.closest('[data-jws-webgl-slideshow]').length;
    return !isCustomAnimation && !hasCustomAnimationParent && !hasAccordionParent && !hasTabParent && !webglSlideshowParent;
  });

  $elements.jwsSplitText();
  
});  



(function ($) {
  'use strict';

  const pluginName = 'jwsMarquee';
  let defaults = {
    items: '.marquee-list-items',
    item: '.item',
    speed: 0.5,
    reversed: !1,
    scroll: !1
  };
  class Plugin {
    constructor(element, options) {
    this._defaults = defaults;
    this._name = pluginName;
    this.options = {
        ...defaults,
        ...options
     };
     this.element = element;
     this.$element = $(element);
    
   
    
    this._ui = [];
      
    const all_item = this.element.querySelectorAll(".item");
    
    all_item.forEach((t, e) => {
        
     this._ui[e] = t
      
    });
  
    this.size = {
        width: 0,
        height: 0
    };
    
    this.items = this._ui.map(e=>({
            el: e,
            size: {
                width: 0,
                height: 0
            },
            position: {
                x: 0
            }
     })),
     
     this.init();

    }
   
     init() {
      this.measure(); 
      this.fill(); 
      this.getStartX();
      this.createmarquee();
      this.setIntersectionObserver(),
      this.options.scroll && this.srolltrigger();
    }
    
   async measure() {
   // return fastdom.mutate(() => {
        this.size.width = this.element.offsetWidth;
        this.items.forEach((e,t)=>{
            e.size = {
                width: e.el.offsetWidth,
                height: e.el.offsetHeight
            },
            e.position = {
                x: e.el.offsetLeft
            },
            t === 0 && (this.size.height = e.size.height),
            t > 0 && e.size.height > this.items[t - 1].size.height && (this.size.height = e.size.height)
        })
    // });
    }
     async fill() {
        const e = this.items.at(-1);
      
      if( e.size.width + e.position.x < this.size.width) {
    
      
            if (this.isDestroyed)
                return;
            const t = this.element.querySelector(".marquee-list-items");
           
           
            let l = !1
              , n = 0;
            for (; !l; ) {
                const s = {
                    el: this.items[n].el.cloneNode(!0),
                    size: {
                        ...this.items[n].size
                    },
                    position: {
                        ...this.items[n].position
                    }
                };
              
                t.insertAdjacentElement("beforeend", s.el),
                s.position.x = s.el.offsetLeft,
                this.items.push(s),
                n++,
                s.size.width + s.position.x > this.size.width && (l = !0)
            }
           }
    }
    getStartX() {
        this.startX = this.items[0].position.x - parseInt(getComputedStyle(this.items[0].el).marginInlineEnd, 10)
    }
    
    createmarquee() {
        
        const {
          items,
          item
        }  = this.options;
        const e = this.getItemElements();
        this.timeline = gsap.timeline({
            repeat: -1,
            paused: !0,
            defaults: {
                ease: "none"
            },
            onReverseComplete: ()=>this.timeline.totalTime(this.timeline.rawTime() + this.timeline.duration() * 100)
        });
        const t = this.items.length
          , l = this.items[t - 1]
          , n = []
          , h = []
          , s = this.options.speed * 100
          , m = i=>i;
        let c, o, d, a;
      
        gsap.set(e, {
            xPercent: (i,r)=>{
                const p = this.items[i].size.width;
                return h[i] = m(parseFloat(gsap.getProperty(r, "x", "px")) / p * 100 + gsap.getProperty(r, "xPercent")),
                h[i]
            }
            ,
            x: 0
        }),
        c = l.position.x + h[t - 1] / 100 * l.size.width - this.startX + l.size.width * gsap.getProperty(e[t - 1], "scaleX");

        for (let i = 0; i < t; i++) {
            const r = this.items[i];
            o = h[i] / 100 * r.size.width,
            d = r.position.x + o - this.startX,
            a = d + r.size.width * gsap.getProperty(r.el, "scaleX"),
            this.timeline.to(r.el, {
                xPercent: m((o - a) / r.size.width * 100),
                duration: a / s
            }, 0).fromTo(r.el, {
                xPercent: m((o - a + c) / r.size.width * 100)
            }, {
                xPercent: h[i],
                duration: (o - a + c - o) / s,
                immediateRender: !1
            }, a / s).add("label" + i, d / s),
            n[i] = d / s
        }
        this.timeline.times = n
        this.timeline.progress(1, !0).progress(0, !0),
        this.options.reversed && this.timeline.vars.onReverseComplete()
        
    }
    srolltrigger() {
        const t = this.options.reversed ? -1 : 1
        , l = gsap.utils.clamp(-6, 6);
        this.STTween = gsap.to(this.timeline, {
            duration: 1.5,
            timeScale: t,
            paused: !0
        }),
        this.ST = ScrollTrigger.create({
            start: 0,
            end: "max",
            onUpdate: n=>{
                this.isPaused || (this.timeline.timeScale(l(n.getVelocity() / 200 * t)),
                this.STTween.invalidate().restart())
            }
        })
    }
    
    play() {

        this.setWillChange("transform"),
        this.options.reversed ? this.timeline.reverse() : this.timeline.play(),
        this.isPaused = !1
        
    }
    pause() {
        this.setWillChange(""),
        this.timeline.pause(),
        this.isPaused = !0
    }
    setIntersectionObserver() {
        new IntersectionObserver(([e],t)=>{
            if (this.isDestroyed)
                return t.disconnect();
            e.isIntersecting ? this.play() : this.pause()
        }
        ).observe(this.element)
    }
    setWillChange(e) {
        this.getItemElements().forEach(t=>t.style.willChange = e)
    }
    getItemElements() {
        return this.items.map(e=>e.el)
    }
    
  }
  $.fn[pluginName] = function (options) {
    return this.each(function () {
      const pluginOptions = $(this).data('marquee-options') || options;
      if (!$.data(this, "plugin_" + pluginName)) {
        $.data(this, "plugin_" + pluginName, new Plugin(this, pluginOptions));
      }
    });
  };
})(jQuery);


(function ($) {
  'use strict';

  const pluginName = 'jwsCustomAnimations';
  let defaults = {
    delay: 160,
    startDelay: 0,
    direction: 'forward',
    duration: 1600,
    ease: 'power4.out',
    animationTarget: 'this',
    addPerspective: true,
    perspectiveVal: 1400,
    initValues: {
      x: 0,
      y: 0,
      z: 0,
      rotationX: 0,
      rotationY: 0,
      rotationZ: 0,
      scaleX: 1,
      scaleY: 1,
      skewX: 0,
      skewY: 0,
      opacity: 1,
      transformOriginX: 50,
      transformOriginY: 50,
      transformOriginZ: '0px'
    },
    animations: {
      transformOriginX: 50,
      transformOriginY: 50,
      transformOriginZ: '0px'
    },
    randomizeInitValues: false,
    randomizeTargets: false,
    clearProps: 'transform,opacity,transform-origin'
  };
  class Plugin {
    constructor(element, options) {
      this._defaults = defaults;
      this._name = pluginName;
      this.options = {
        ...defaults,
        ...options
      };
      this.options.duration = this.options.duration / 1000;
      this.options.offDuration = this.options.offDuration / 1000;
      this.options.offDelay = this.options.offDelay / 1000;
      this.options.delay = this.options.delay / 1000;
      this.options.startDelay = this.options.startDelay / 1000;
      this.element = element;
      this.$element = $(element);
      this.animationTargets = [];
      this.animationsTimeline = null;
      this.animationsStarted = false;
      this.needPerspective = this.options.addPerspective && this._needPerspective();
      this.animationsInitiatedPromise = new Promise(resolve => {
        this.$element.on('lqdanimationsinitiated', resolve.bind(this, this));
      });
      this.animationsDonePromise = new Promise(resolve => {
        this.$element.on('lqdanimationsdone', resolve.bind(this, this));
      });
      new IntersectionObserver(([entry], observer) => {
        if (entry.isIntersecting) {
          observer.disconnect();
          this._build();
        }
      }, {
        rootMargin: '8%'
      }).observe(this.element);
    }
    _build() {
      const $rowBgParent = this.$element.closest('[data-row-bg]');
      const $slideshowBgParent = this.$element.closest('[data-slideshow-bg]');
      const promises = [];
      if (!this.element.classList.contains('vc_row')) {
        const $splitTextEls = this.$element.find('[data-split-text]');
        if (this.element.hasAttribute('data-split-text')) {
          $splitTextEls.push(this.element);
        }
        if ($splitTextEls.length) {
          $splitTextEls.each((i, el) => {
            const $el = $(el);
            $el.jwsSplitText({
              forceApply: true
            });
            const prom = $el.data('plugin_jwsSplitText');
            prom && promises.push(prom.splitDonePormise);
          });
        }
      }
      if ($rowBgParent.length) {
        const prom = $rowBgParent.data('plugin_jwsRowBG');
        prom && promises.push(prom.rowBgInitPromise);
      }
      if ($slideshowBgParent.length) {
        const prom = $slideshowBgParent.data('plugin_jwsSlideshowBG');
        prom && promises.push(prom.slideshowBgInitPromise);
      }
      if (promises.length > 0) {
        Promise.all(promises).then(() => {
          this._init();
        });
      } else {
        this._init();
      }
    }
    _init() {
      this._getAnimationTargets();
      this._createTimeline();
      this._initValues();
      this._runAnimations();
      this._initPlugins();
    }
    _getAnimationTargets() {
      const {
        animationTarget
      } = this.options;
      let targets = null;
      switch (animationTarget) {
        case 'this':
          targets = this.element;
          break;
        case 'all-childs':
          targets = this._getChildElments();
          break;
        default:
          targets = this.element.querySelectorAll(animationTarget);
          break;
      }
      this.animationTargets = Array.from(targets);
    }
    _getChildElments() {
      let $childs = this.$element.children();
      return this._getInnerChildElements($childs);
    }
    _getInnerChildElements(elements) {
      const elementsArray = [];
      let $elements = $(elements).map((i, element) => {
        const $element = $(element);
        if ($element.hasClass('vc_inner') || $element.hasClass('vc_vc_row_inner')) {
          return $element.find('.wpb_wrapper').children().get();
        } else if ($element.hasClass('row')) {
          return $element.find('.jws-column').children().get();
        } else if ($element.hasClass('ld-slideelement-visible') || $element.hasClass('ld-slideelement-hidden')) {
          return $element.children().children().get();
        } else if ($element.hasClass('elementor-container')) {
          return $element.children('.elementor-column').get();
        } else if ($element.hasClass('elementor-widget-wrap')) {
          return $element.children('.elementor-element').get();
        } else {
          return $element.not('style, .jws-exclude-parent-ca').get();
        }
      });
      $.each($elements, (i, element) => {
        const $element = $(element);
        if (element.hasAttribute('data-custom-animations')) {
          return elementsArray.push(element);
        }
        if (element.querySelector('[data-custom-animations]')) {
          return element.querySelectorAll('[data-custom-animations]').forEach(el => {
            elementsArray.push(el);
          });
        }
        if (element.tagName === 'UL') {
          return $.each($element.children(), (i, li) => {
            elementsArray.push(li);
          });
        }
        if (element.classList.contains('jws-custom-menu')) {
          return $.each($element.find('> ul > li'), (i, li) => {
            elementsArray.push(li);
          });
        }
        if (element.classList.contains('accordion')) {
          return $.each($element.children(), (i, accordionItem) => {
            elementsArray.push(accordionItem);
          });
        }
        if (element.classList.contains('vc_inner') || element.classList.contains('vc_vc_row_inner')) {
          return $.each($element.find('.wpb_wrapper'), (i, innerColumn) => {
            elementsArray.push(innerColumn);
          });
        }
        if (element.classList.contains('row')) {
          return $.each($element.find('.jws-column'), (i, innerColumn) => {
            elementsArray.push(innerColumn);
          });
        }
        if (element.classList.contains('jws-pb-container')) {
          return $.each($element.find('.jws-pb'), (i, processBoxElement) => {
            elementsArray.push(processBoxElement);
          });
        }
        if ($element.find('[data-split-text]').length || element.hasAttribute('data-split-text')) {
          if (element.classList.contains('btn') || element.classList.contains('vc_ld_button')) {
            return elementsArray.push($element[0]);
          } else {
            return $.each($element.find('.split-inner'), (i, splitInner) => {
              const $innerSplitInner = $(splitInner).find('.split-inner');
              if ($innerSplitInner.length) {
                elementsArray.push($innerSplitInner[0]);
              } else {
                elementsArray.push(splitInner);
              }
            });
          }
        }
        if (!element.classList.contains('vc_empty_space') && !element.classList.contains('ld-empty-space') && !element.classList.contains('vc_ld_spacer') && !element.classList.contains('ld-particles-container') && !element.classList.contains('elementor-widget-spacer') && !element.hasAttribute('data-split-text') && element.tagName !== 'STYLE') {
          return elementsArray.push($element[0]);
        }
      });
      return elementsArray;
    }
    _needPerspective() {
      const initValues = this.options.initValues;
      const valuesNeedPerspective = ["z", "rotationX", "rotationY"];
      let needPerspective = false;
      for (let prop in initValues) {
        for (let i = 0; i <= valuesNeedPerspective.length - 1; i++) {
          const val = valuesNeedPerspective[i];
          if (prop === val) {
            needPerspective = true;
            break;
          }
        }
      }
      return needPerspective;
    }
    _generateRandomValues(valuesObject) {
      const obj = {
        ...valuesObject
      };
      for (const ky in valuesObject) {
        if (ky.search('transformOrigin') < 0 && ky.search('opacity') < 0) {
          obj[ky] = () => gsap.utils.random(0, valuesObject[ky]);
        }
        ;
      }
      return obj;
    }
    _createTimeline() {
      const {
        ease,
        duration,
        clearProps
      } = this.options;
      this.animationsTimeline = gsap.timeline({
        defaults: {
          duration,
          ease,
          clearProps
        },
        onComplete: this._onTimelineAnimationComplete.bind(this)
      });
    }
    _initValues() {
      const {
        options
      } = this;
      const {
        randomizeInitValues,
        initValues
      } = options;
      const $animationTargets = $(this.animationTargets);
      const initProps = !randomizeInitValues ? initValues : this._generateRandomValues(initValues);
      $animationTargets.css({
        transition: 'none',
        transitionDelay: 0
      }).addClass('will-change');
      if (this.needPerspective) {
        $animationTargets.parent().parent().addClass('perspective');
        $animationTargets.each((i, animTarget) => {
          const $animTarget = $(animTarget);
          if (!$animTarget.hasClass('jws-imggrp-single')) {
            $animTarget.parent().addClass('transform-style-3d');
          }
        });
      }
      gsap.set(this.animationTargets, {
        ...initProps
      });
      this.element.classList.add('ca-initvalues-applied');
      this.$element.trigger('lqdanimationsinitiated', this);
    }
    async _runAnimations() {
      const {
        delay,
        startDelay,
        animations,
        direction
      } = this.options;
      const stagger = {
        from: direction,
        each: delay
      };
      if (direction === 'forward') {
        stagger['from'] = 'start';
      } else if (direction === 'backward') {
        stagger['from'] = 'end';
      }
      this.animationsTimeline.to(this.animationTargets, {
        ...animations,
        stagger,
        delay: startDelay,
        onStart: () => {
          this.animationsStarted = true;
        },
        onComplete: this._onUnitsAnimationsComplete,
        onCompleteParams: [this.animationTargets]
      });
    }
    _onTimelineAnimationComplete() {
         this.$element.addClass('jws-animations-done');
      this.$element.trigger('lqdanimationsdone', this);
      if (this.needPerspective) {
        $(this.animationTargets).parent().parent().removeClass('perspective');
        $(this.animationTargets).parent().removeClass('transform-style-3d');
      }
     
    }
    _onUnitsAnimationsComplete(animationTargets) {
      animationTargets.forEach(element => {
        element.style.transition = '';
        element.style.transitionDelay = '';
        element.classList.remove('will-change');
        if (element.classList.contains('split-inner')) {
          element.parentElement.classList.add('jws-unit-animation-done');
        } else {
          element.classList.add('jws-unit-animation-done');
        }
      });
    }
    _initPlugins() {
      this.$element.find('[data-slideelement-onhover]').filter((i, element) => {
        return element.clientHeight > 0;
      }).jwsSlideElement();
      this.element.hasAttribute('data-slideelement-onhover') && this.$element.jwsSlideElement();
    }
    destroy() {
      
      this.element.classList.remove('ca-initvalues-applied', 'jws-animations-done', 'transform-style-3d');
      this.animationTargets.forEach(target => {
        if (!target.vars) {
          target.classList.remove('will-change');
          if (target.classList.contains('split-inner')) {
            target.parentElement.classList.remove('jws-unit-animation-done');
          } else {
            target.classList.remove('jws-unit-animation-done');
          }
          gsap.set(target, {
            clearProps: 'all'
          });
        } else {
          this.animationsTimeline.killTweensOf(target);
        }
      });
      if (this.animationsTimeline) {
        this.animationsTimeline.kill();
        this.animationsTimeline.clear();
      }
      $.data(this.element, 'plugin_' + pluginName, null);
    }
  }
  $.fn[pluginName] = function (options) {
    return this.each(function () {
      const $this = $(this);
      const plugin = `plugin_${pluginName}`;
      const pluginOptions = {
        ...$this.data('ca-options'),
        ...options
      };

      let {
        initValues,
        animations
      } = pluginOptions;
      function handleTransformOrigins(opts) {
        if (!opts) return;
        const {
          transformOriginX,
          transformOriginY,
          transformOriginZ
        } = opts;
        if (transformOriginX && typeof transformOriginX === 'number') {
          opts.transformOriginX = transformOriginX + '%';
        }
        if (transformOriginY && typeof transformOriginY === 'number') {
          opts.transformOriginY = transformOriginY + '%';
        }
        if (transformOriginZ && typeof transformOriginZ === 'number') {
          opts.transformOriginZ = transformOriginZ + '%';
        }
        if (transformOriginX && transformOriginY && transformOriginZ) {
          opts.transformOrigin = `${opts.transformOriginX} ${opts.transformOriginY} ${opts.transformOriginZ}`;
          delete opts.transformOriginX;
          delete opts.transformOriginY;
          delete opts.transformOriginZ;
        }
        return opts;
      }
      initValues = handleTransformOrigins(initValues);
      animations = handleTransformOrigins(animations);
      if (!$.data(this, plugin)) {
        $.data(this, `plugin_${pluginName}`, new Plugin(this, pluginOptions));
      }
    });
  };
})(jQuery);
jQuery(document).ready(function ($) {
  const anims = $('[data-custom-animations]').filter((i, element) => {
    const $element = $(element);
    const stackOptions = $jwsContents.length && $jwsContents[0].getAttribute('data-stack-options');
    const stackDisableOnMobile = stackOptions && JSON.parse(stackOptions).disableOnMobile === true;
    return (!stackOptions || stackOptions && stackDisableOnMobile && (jwsIsMobile() || jwsWindowWidth() <= jwsMobileNavBreakpoint())) && !$element.hasClass('carousel-items');
  }).get().reverse();
  if (anims.length < 1) {
    return;
  }
  ;
  if (jwsIsMobile() && document.body.hasAttribute('data-disable-animations-onmobile')) {
    return $(anims).addClass('ca-initvalues-applied');
  }
  ;
  if ($jwsBody.hasClass('jws-preloader-activated') && $('.jws-preloader-wrap').length) {
    document.addEventListener('jws-preloader-anim-done', () => {
      $(anims).jwsCustomAnimations();
    });
  } else {
    $(anims).jwsCustomAnimations();
  }
});

(function ($) {
  'use strict';

  const pluginName = 'jwsSlideElement';
  let defaults = {
    hiddenElement: null,
    visibleElement: null,
    hiddenElementOnHover: null,
    alignMid: false,
    waitForSplitText: false,
    disableOnMobile: false,
    triggerElement: 'self'
  };
  class Plugin {
    constructor(element, options) {
      this._defaults = defaults;
      this._name = pluginName;
      this.options = {
        ...defaults,
        ...options
      };
      this.element = element;
      this.$element = $(element);
      this.$triggerElement = this.options.triggerElement === 'self' ? this.$element : this.$element.closest(this.options.triggerElement);
      this.timeline = gsap.timeline();
      if (this.options.waitForSplitText) {
        const $splitTextEls = this.$element.find('[data-split-text]');
        const promises = [];
        if ($splitTextEls.length) {
          $splitTextEls.jwsSplitText({
            forceApply: true
          });
          $splitTextEls.each((i, el) => {
            const $el = $(el);
            const splitTextData = $el.data('plugin_jwsSplitText');
            if (splitTextData) {
              promises.push(splitTextData.splitDonePormise);
            }
          });
        }
        if (promises.length > 0) {
          Promise.all(promises).then(this.init.bind(this));
        }
      } else {
        this.init();
      }
    }
    init() {
      this.getElements();
      if (!this.$hiddenElement.length || !this.$visibleElement.length) {
        return;
      }
      imagesLoaded(this.element, () => {
        this.hiddenElementHeight = this.getHiddenElementHeight();
        this.$element.addClass('hide-target');
        this.createTimeline();
        this.moveElements();
        this.eventListeners();
      });
    }
    getElements() {
      this.$hiddenElement = $(this.options.hiddenElement, this.element);
      this.$visibleElement = $(this.options.visibleElement, this.element);
      this.$hiddenElementOnHover = $(this.options.hiddenElementOnHover, this.element);
      this.$hiddenElement.wrap('<div class="ld-slideelement-hidden" />').wrap('<div class="ld-slideelement-hidden-inner" />');
      this.$visibleElement.wrap('<div class="ld-slideelement-visible" />').wrap('<div class="ld-slideelement-visible-inner" />');
      this.$hiddenElementWrap = this.$hiddenElement.closest('.ld-slideelement-hidden');
      this.$hiddenElementInner = this.$hiddenElement.closest('.ld-slideelement-hidden-inner');
      this.$visibleElementWrap = this.$visibleElement.closest('.ld-slideelement-visible');
      this.$visibleElementInner = this.$visibleElement.closest('.ld-slideelement-visible-inner');
    }
    getHiddenElementHeight() {
      let height = 0;
      $.each(this.$hiddenElement, (i, element) => {
        height += $(element).outerHeight(true);
      });
      return height;
    }
    getHiddenElementChilds() {
      return this.$hiddenElementInner.children().map((i, childElement) => childElement.parentElement);
    }
    getVisibleElementChilds() {
      return this.$visibleElementInner.children().map((i, childElement) => childElement.parentElement);
    }
    moveElements() {
      const translateVal = this.options.alignMid ? this.hiddenElementHeight / 2 : this.hiddenElementHeight;
      this.$visibleElementWrap.css({
        transform: `translateY(${translateVal}px)`
      });
      this.$hiddenElementWrap.css({
        transform: `translateY(${translateVal}px)`
      });
    }
    createTimeline() {
      const {
        options
      } = this;
      const childElements = [...this.getVisibleElementChilds(), ...this.getHiddenElementChilds()];
      let translateVal = options.alignMid ? this.hiddenElementHeight / 2 : this.hiddenElementHeight;
      if (options.hiddenElementOnHover) {
        const elementHeight = this.$hiddenElementOnHover.outerHeight(true);
        translateVal = options.alignMid ? (this.hiddenElementHeight + elementHeight) / 2 : this.hiddenElementHeight + elementHeight;
      }
      this.timeline.to(childElements, {
        y: translateVal * -1,
        opacity: (i, element) => {
          if ($(element).is($(this.$hiddenElementOnHover).parent())) {
            return 0;
          }
          return 1;
        },
        ease: 'power3.out',
        duration: 0.65,
        stagger: 0.065
      }).pause();
    }
    eventListeners() {
      const onResize = jwsDebounce(this.onWindowResize.bind(this), 500);
      this.$triggerElement.on('mouseenter.jwsSlideElementOnHover', this.onMouseEnter.bind(this));
      this.$triggerElement.on('mouseleave.jwsSlideElementOnHover', this.onMouseLeave.bind(this));
      $(window).on('resize.jwsSlideElementOnResize', onResize);
    }
    onMouseEnter() {
      this.timeline.play();
    }
    onMouseLeave() {
      this.timeline.reverse();
    }
    onWindowResize() {
      this.hiddenElementHeight = this.getHiddenElementHeight();
      this.moveElements();
    }
    destroy() {
      this.$triggerElement.off('mouseenter.jwsSlideElementOnHover mouseleave.jwsSlideElementOnHover');
      $(window).off('resize.jwsSlideElementOnResize');
    }
  }
  $.fn[pluginName] = function (options) {
    return this.each(function () {
      const pluginOptions = {
        ...$(this).data('slideelement-options'),
        ...options
      };
      if (pluginOptions.disableOnMobile && jwsIsMobile()) {
        return;
      }
      if (!$.data(this, "plugin_" + pluginName)) {
        $.data(this, "plugin_" + pluginName, new Plugin(this, pluginOptions));
      }
    });
  };
})(jQuery);
jQuery(document).ready(function ($) {
  const $elements = $('[data-slideelement-onhover]').filter((i, element) => {
    return !$(element).parents('[data-custom-animations]').length && !element.hasAttribute('data-custom-animations') && element.clientHeight > 0;
  });
  $elements.jwsSlideElement();
});

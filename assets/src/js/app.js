/**
 * Namespace.
 *
 * @since 1.0.0
 * 
 * @type {Object}
 */
let cahu = cahu || {};

/**
 * Helper.
 *
 * @since 1.0.0
 * 
 * @type {Object}
 */
cahu.fn = {

    /**
     * Global event listener delegation.
     *
     * @since 1.0.0
     * 
     * @param  {string}    type      Event type can be multiple seperate with space.
     * @param  {string}    selector  Target element.
     * @param  {Function}  callback  Callback function.
     */
    eventListener: async function( type, selector, callback ) {
        const events = type.split(' ');
        events.forEach( function( event ) {
            document.addEventListener( event, function( e ) {
                if ( e.target.matches( selector ) ) {
                    callback( e );
                }
            });
        });
    },

    /**
     * Fetch handler.
     *
     * @since 1.0.0
     * 
     * @param  {object}  params  Containing the parameters.
     * @return {object}
     */
    fetch: async function( params ) {
        const data = {
            result: [],
            success: false
        };

        if ( this.isObjectEmpty( params ) ) return data;

        try {
            const response = await fetch( cahuLocalizeAjax.url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams( params )
            });

            if ( response.ok ) {
                const result = await response.json();
                console.log( result );
                if ( result.success === true ) {
                    data.result  = result.data;
                    data.success = true;
                }
            }
        } catch( e ) {
            console.log('error', e);
        }

        return data;
    },

    /**
     * Checks if the object is empty.
     *
     * @since 1.0.0
     * 
     * @param  {Object}  object  The object to be checked.
     * @return {boolean}
     */
    isObjectEmpty: function( object ) {
        return Object.keys( object ).length === 0;
    },

    /**
     * Animating count up of a centain element.
     *
     * @since 1.0.0
     * 
     * @param  {Object}  elem      The target element.
     * @param  {number}  end       The end or total count.
     * @param  {number}  duration  The total duration of animation in miliseconds.
     */
    animateCountUp: function( elem, end, duration ) {
        const start = 0;
        let startTimestamp = null;
        const step = ( timestamp ) => {
            if ( ! startTimestamp ) startTimestamp = timestamp;
            const progress = Math.min( ( timestamp - startTimestamp ) / duration, 1 );
            elem.innerHTML = Math.floor( progress * ( end - start ) + start ) + '+';
            if ( progress < 1 ) {
                window.requestAnimationFrame( step );
            }
        };
        window.requestAnimationFrame( step );
    },

    /**
     * Check if the element is visible in the viewing screen.
     *
     * @since 1.0.0
     * 
     * @param  {Object}  elem  The target element.
     * @return {Boolean}
     */
    isElementVisibleInScreen: function( elem ) {
        if ( ! elem ) return;
        
        let rect = elem.getBoundingClientRect(),
        viewHeight = Math.max( document.documentElement.clientHeight, window.innerHeight );
        return ! ( rect.bottom < 0 || rect.top - viewHeight >= 0 );
    }
};

/**
 * Header Component Event.
 *
 * @since 1.0.0
 * 
 * @type {Object}
 */
cahu.header = {

    /**
     * Initialize.
     *
     * @since 1.0.0
     */
    init: function() {
        this.addScrollClassInBody();
        this.toggleSearchForm();
    },

    /**
     * Adding a scroll class in the body tag
     * when the header is not visible or offset.
     *
     * @since 1.0.0
     */
    addScrollClassInBody: function() {
        window.addEventListener( 'scroll', function(e) {
            const body   = document.body,
                  offset = window.pageYOffset,
                  headerHeight = document.getElementById('cu-js-header').offsetHeight;

            if ( offset > headerHeight ) {
                body.classList.add( 'cu-scrolled' );
            } else {
                body.classList.remove( 'cu-scrolled' );
            }
        });
    },

    /**
     * Toggle the search form in the header.
     *
     * @since 1.0.0
     */
    toggleSearchForm: function() {
        cahu.fn.eventListener( 'click', '#cu-js-header-search-btn', function( e ) {
            const target = e.target,
                  parentElem = target.parentNode;
            if ( ! parentElem ) return;

            const state = parentElem.getAttribute( 'data-state' );
            parentElem.setAttribute( 'data-state', ( state == 'close' ? 'open' : 'close' ) );
            target.setAttribute( 'title', ( state == 'close' ? 'Close Search Form' : 'Open Search Form' ) );
        });
    }
};

/**
 * Sidebar Navigation Component Event.
 *
 * @since 1.0.0
 * 
 * @type {Object}
 */
cahu.sidebarNavigation = {

    /**
     * Initialize.
     *
     * @since 1.0.0
     */
    init: function() {
        this.appendExpandButton();
        this.toggleSubMenu();
        this.toggleSidebarMenu();
    },

    /**
     * Append the expand button in the navigation
     * whose have a sub-menu. (li.menu-item-has-children.)
     *
     * @since 1.0.0
     */
    appendExpandButton: function() {
        const navElems = document.querySelectorAll('.mjnav');
        if ( navElems.length === 0 ) return;

        navElems.forEach( function( navElem ) {
            const liElems = navElem.querySelectorAll('li.menu-item-has-children');
            liElems.forEach( function( liElem ) {
                const buttonElem = document.createElement('button');
                buttonElem.classList.add('mjnav__expand-btn');
                buttonElem.setAttribute('data-state', 'closed');
                buttonElem.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="mjnav__svg" viewBox="0 0 512 512">
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M112 328l144-144 144 144"/>
                </svg>`;
                liElem.append( buttonElem );
            });
        });
    },

    /**
     * Toggle the submenu or collpase it down and up.
     *
     * @since 1.0.0
     */
    toggleSubMenu: function() {
        cahu.fn.eventListener( 'click', '.mjnav__expand-btn', function( e ) {
            const target = e.target,
                  state = target.getAttribute('data-state'),
                  submenu = target.previousElementSibling;

            if ( state == 'opened' ) {
                target.setAttribute('data-state', 'closed')
                submenu.style.maxHeight = submenu.scrollHeight + 'px';
                setTimeout( function() {
                    submenu.style.maxHeight = null;
                }, 300 );
            } else {
                target.setAttribute('data-state', 'opened');
                submenu.style.maxHeight = submenu.scrollHeight + 'px';
                setTimeout( function() {
                    submenu.style.maxHeight = '100%';
                }, 500 );
            }
        });
    },

    /**
     * Toggle the sidebar menu or slide left or right.
     *
     * @since 1.0.0
     */
    toggleSidebarMenu: function() {
        cahu.fn.eventListener( 'click', '.mjsidebar__toggle-btn', function( e ) {
            const target = e.target,
            event  = target.getAttribute('data-event'),
            sidebarElems = document.querySelectorAll('.mjsidebar');
            if ( sidebarElems.length === 0 ) return;

            sidebarElems.forEach( function( sidebarElem ) {
                const panelElem = document.querySelector('.mjsidebar__panel');
                if ( ! panelElem ) return;

                switch ( event ) {
                    case 'open':
                        sidebarElem.style.display = 'block';
                        panelElem.classList.remove('mjsidebar--slide-left');
                        panelElem.classList.add('mjsidebar--slide-right');
                        break;
                    case 'close':
                        panelElem.classList.remove('mjsidebar--slide-right');
                        panelElem.classList.add('mjsidebar--slide-left');
                        panelElem.addEventListener( 'animationend', function( e ) {
                            if ( e.animationName === 'mjsidebar-slide-left' ) {
                                sidebarElem.style.display = 'none';
                            }
                        });
                        break;
                }
            });
        });
    }
};

/**
 * Accordion Component Event.
 *
 * @since 1.0.0
 * 
 * @type {Object}
 */
cahu.accordion = {

    /**
     * Initialize.
     *
     * @since 1.0.0
     */
    init: function() {
        this.toggleAccordion();
    },

    /**
     * Toggle the accordion state.
     *
     * @since 1.0.0
     */
    toggleAccordion: function() {
        cahu.fn.eventListener( 'click', '.kn-js-accordion-btn', function( e ) {
            const target = e.target,
                  state  = target.getAttribute('data-state'),
                  parentElem = target.closest('.kn-accordion'),
                  bodyElem   = parentElem.querySelector('.kn-accordion__body');

            if ( state == 'close' ) {
                // Collapsing down.
                bodyElem.style.maxHeight =  bodyElem.scrollHeight + 'px';
                setTimeout( function() {
                    bodyElem.style.maxHeight = 'max-content' ;
                }, 500 );
                target.setAttribute( 'data-state', 'open' );
            } else if ( state == 'open' ) {
                // Collapsing up.
                bodyElem.style.maxHeight = bodyElem.scrollHeight + 'px';
                setTimeout( function() {
                    bodyElem.style.maxHeight = null;
                }, 300 );
                target.setAttribute( 'data-state', 'close' );
            }
        });
    }
}

/**
 * On Scroll Animation Event.
 *
 * @since 1.0.0
 * 
 * @type {Object}
 */
cahu.onScrollAnimation = {

    /**
     * Initialize.
     *
     * @since 1.0.0
     */
    init: function() {
        this.animate();
    },

    /**
     * Animate elements if visible within the viewport.
     *
     * @since 1.0.0
     */
    animate: function() {
        const observerOptions = {
            threshold: 0.25,
            rootMargin: "0px 0px 0px 0px"
        };

        const animateOnScroll = new IntersectionObserver( function( entries, animateOnScroll ) {
            entries.forEach( function( entry ) {
                if ( ! entry.isIntersecting ) return;

                entry.target.setAttribute( 'data-animate', 'enable' );
            });
        }, observerOptions );

        const elems = document.querySelectorAll('[data-animate="disable"]');
        if ( elems.length === 0 ) return;

        elems.forEach( function( elem ) {
            const animationDelay = elem.getAttribute('data-delay');
            if ( animationDelay ) {
                elem.style.animationDelay = animationDelay + 's';
            }

            animateOnScroll.observe( elem );
        });
    }
}

/**
 * Site preloader compontent. NOTE this must be
 * the first one to be initialize when the document
 * ready state is completed.
 *
 * @since 1.0.0
 */
cahu.preloader = {

    /**
     * Initialize.
     *
     * @since 1.0.0
     */
    init: function() {
        this.hidePreloader();
    },

    /**
     * Hide the preloader component.
     *
     * @since 1.0.0
     */
    hidePreloader: function() {
        const preloader = document.getElementById('cu-js-preloader');
        if ( preloader ) {
            setTimeout( function() {
                preloader.setAttribute( 'data-visibility', 'hidden' );
                preloader.addEventListener( 'animationend', function() {
                    preloader.remove();
                });
            }, 1000 );
        }
    }
}

/**
 * Is Dom Ready.
 *
 * @since 1.0.0
 */
cahu.domReady = {

    /**
     * Execute the code when dom is ready.
     *
     * @param  {[type]} func [description]
     * @return {[type]}      [description]
     */
    execute: function( func ) {
        if ( typeof func !== 'function' ) return;
        if ( document.readyState === 'interactive' || document.readyState === 'complete' ) {
            return func();
        }

        document.addEventListener( 'DOMContentLoaded', func, false );
    }
};

cahu.domReady.execute( function() {
    cahu.preloader.init();         // Handle the preloader component.
    cahu.header.init();            // Handle the header component.
    cahu.sidebarNavigation.init()  // Handle the sidebar navigation component.
    cahu.accordion.init();         // Handle the accordion component.
    cahu.onScrollAnimation.init(); // Handle the on scroll animation.
});
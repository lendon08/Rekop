/*! swap.js | Copyright © 2011-2024 CallRail Inc. | License: www.callrail.com/legal */ !(function () {
    "use strict";
    var Wrappers = (function () {
            function e() {}
            return (
                (e.documentReferrer = function () {
                    return document.referrer;
                }),
                (e.documentURL = function () {
                    return document.URL;
                }),
                (e.documentCookie = function (e) {
                    return e ? (document.cookie = e) : document.cookie;
                }),
                (e.isDebug = function () {
                    return Debug._isDebug || !1;
                }),
                (e.windowLocation = function () {
                    return window.location;
                }),
                e
            );
        })(),
        Debug = (function () {
            function e() {}
            return (
                (e._debugEnabled = function () {
                    return !!Wrappers.windowLocation().href.match(/crl?dbg/);
                }),
                (e.doneSwaps = {}),
                (e.foundTargets = []),
                e
            );
        })(),
        Performance = (function () {
            function o() {}
            return (
                (o.networkPerfData = function () {
                    if (o._networkPerfData) return o._networkPerfData;
                    if (((o._networkPerfData = {}), window.performance))
                        try {
                            var e = window.performance
                                .getEntriesByType("resource")
                                .filter(function (e) {
                                    return e.name.match(/swap\.js/);
                                })[0];
                            if (e) {
                                var r =
                                        0 < e.encodedBodySize &&
                                        0 < e.transferSize &&
                                        e.transferSize < e.encodedBodySize,
                                    t = 0 === e.duration;
                                if (r || t) return {};
                                var a =
                                    0 < e.secureConnectionStart
                                        ? e.secureConnectionStart
                                        : e.connectEnd;
                                o._networkPerfData = {
                                    dns:
                                        e.domainLookupEnd - e.domainLookupStart,
                                    conn: a - e.connectStart,
                                    tls: e.connectEnd - a,
                                    wait: e.responseStart - e.requestStart,
                                    recv: e.responseEnd - e.responseStart,
                                };
                            }
                        } catch (n) {}
                    return o._networkPerfData;
                }),
                (o.reset = function (e) {
                    (o._networkPerfData = {}), e && delete o._throttleQueue[e];
                }),
                (o.runtimePerfData = function () {
                    return o._runtimePerfData;
                }),
                (o.throttle = function (e, r, t) {
                    if (!window.performance) return !0;
                    this._throttleQueue[e] || (this._throttleQueue[e] = []);
                    var a = this._throttleQueue[e];
                    if (0 < a.length) {
                        if (16.5 < a[a.length - 1].duration)
                            return (
                                (this._runtimePerfData[e] =
                                    a[a.length - 1].duration),
                                (this._runtimePerfData[e + "_throttling"] = 1),
                                !0
                            );
                        if (
                            a.length >= r &&
                            a[0].startTime > window.performance.now() - 6e4
                        )
                            return (
                                (this._runtimePerfData[e + "_throttling"] = 1),
                                !0
                            );
                    }
                    var n = window.performance.now();
                    t();
                    var o = window.performance.now() - n;
                    return (
                        a.push({ startTime: n, duration: o }),
                        a.length > r && a.shift(),
                        (this._runtimePerfData[e] = o),
                        !1
                    );
                }),
                (o._runtimePerfData = {}),
                (o._throttleQueue = {}),
                o
            );
        })(),
        Polyfills = (function () {
            function t() {}
            return (
                (t.jsonify = function (e) {
                    var r = Array.prototype.toJSON;
                    if (!r) return JSON.stringify(e);
                    delete Array.prototype.toJSON;
                    var t = JSON.stringify(e);
                    return (Array.prototype.toJSON = r), t;
                }),
                (t.contains = function (e, r) {
                    return -1 < t.indexOf(e, r);
                }),
                (t.indexOf = function (e, r) {
                    if (e.indexOf) return e.indexOf(r);
                    for (var t = 0; t < e.length; t++) if (e[t] === r) return t;
                    return -1;
                }),
                (t.isArray = function (e) {
                    return Array.isArray
                        ? Array.isArray(e)
                        : "[object Array]" ===
                              Object.prototype.toString.call(e);
                }),
                (t.documentReady = function (e) {
                    "loading" !== document.readyState
                        ? e()
                        : document.addEventListener
                        ? document.addEventListener("DOMContentLoaded", e)
                        : document.attachEvent(
                              "onreadystatechange",
                              function () {
                                  "loading" !== document.readyState && e();
                              }
                          );
                }),
                (t.hasClass = function (e, r) {
                    return e.classList
                        ? e.classList.contains(r)
                        : new RegExp("(^| )" + r + "( |$)", "gi").test(
                              e.className
                          );
                }),
                (t.isEmptyObject = function (e) {
                    for (var r in e) return !1;
                    return !0;
                }),
                (t.assign = function (e, r) {
                    for (var t in r) e[t] = r[t];
                }),
                t
            );
        })(),
        Storage = (function () {
            function t() {}
            return (
                (t.hasCookie = function (e) {
                    return (
                        null != Wrappers.documentCookie() &&
                        !(t.cookieValues(e).length < 1)
                    );
                }),
                (t.cookieValues = function (e) {
                    for (
                        var r = e + "=",
                            t = Wrappers.documentCookie().split(";"),
                            a = [],
                            n = 0;
                        n < t.length;
                        n++
                    ) {
                        for (var o = t[n]; " " === o.charAt(0); )
                            o = o.substring(1, o.length);
                        0 === o.indexOf(r) &&
                            a.push(unescape(o.substring(r.length, o.length)));
                    }
                    return a;
                }),
                (t.setItem = function (e, r) {
                    return (
                        (e = "calltrk-" + e),
                        r === undefined
                            ? window.localStorage.removeItem(e)
                            : window.localStorage.setItem(
                                  e,
                                  Polyfills.jsonify(r)
                              ),
                        t.getItem(e)
                    );
                }),
                (t.getItem = function () {
                    for (var e = [], r = 0; r < arguments.length; r++)
                        e[r] = arguments[r];
                    for (var t = 0; t < e.length; t++) {
                        var a = "calltrk-" + e[t],
                            n = window.localStorage.getItem(a);
                        if (n) return JSON.parse(n);
                    }
                    return null;
                }),
                (t.removeItem = function () {
                    for (var e = [], r = 0; r < arguments.length; r++)
                        e[r] = arguments[r];
                    for (var t = 0; t < e.length; t++) {
                        var a = "calltrk-" + e[t];
                        window.localStorage.removeItem(a);
                    }
                    return null;
                }),
                t
            );
        })(),
        Session = (function () {
            function l() {}
            return (
                (l.generateUUID = function () {
                    var t = window.crypto || window.msCrypto;
                    return t && t.getRandomValues
                        ? "10000000-1000-4000-8000-100000000000".replace(
                              /[018]/g,
                              function (e) {
                                  var r = parseInt(e, 10);
                                  return (
                                      r ^
                                      (t.getRandomValues(new Uint8Array(1))[0] &
                                          (15 >> (r / 4)))
                                  ).toString(16);
                              }
                          )
                        : "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(
                              /[xy]/g,
                              function (e) {
                                  var r = (16 * Math.random()) | 0;
                                  return ("x" == e ? r : (3 & r) | 8).toString(
                                      16
                                  );
                              }
                          );
                }),
                (l.hasWordpressCookies = function () {
                    return 1 <= window.crwpVer;
                }),
                (l.wpProxy = function () {
                    return 2 === window.crwpVer;
                }),
                (l.proxyPath = function (e) {
                    var r;
                    try {
                        r = new URL(e);
                    } catch (t) {
                        (r = document.createElement("a")).href = e;
                    }
                    return (
                        "/index.php?rest_route=/calltrk/sessions" + r.pathname
                    );
                }),
                (l.crossSubdomain = function () {
                    var ns = CallTrk.firstNamespace();
                    return ns && ns.cross_subdomain;
                }),
                (l.cookieDuration = function () {
                    return CallTrk.firstNamespace().cookie_duration;
                }),
                (l.isMulti = function () {
                    return !!CallTrk.firstNamespace().multiswap_id;
                }),
                (l.namespaceIds = function () {
                    var e = [];
                    return (
                        CallTrk.eachNamespace(function (ns) {
                            return e.push(ns.id);
                        }),
                        e
                    );
                }),
                (l.nearestTLD = function () {
                    if (CallTrkSwap._nearestTLD) return CallTrkSwap._nearestTLD;
                    var e = Wrappers.documentCookie(),
                        r = Wrappers.windowLocation().hostname,
                        t = r.split(".");
                    if ("" === r) return "";
                    for (var a = t.length - 1; 0 <= a; --a) {
                        var n = t.slice(a).join(".");
                        if (
                            (l.createCookie("calltrk_nearest_tld", n, 3600, n),
                            e !== Wrappers.documentCookie())
                        )
                            return (
                                l.eraseCookie("calltrk_nearest_tld", n),
                                (CallTrkSwap._nearestTLD = n)
                            );
                    }
                }),
                (l.createCookie = function (e, r, t, a) {
                    var n = "";
                    if ((null == t && (t = l.cookieDuration()), t)) {
                        var o = new Date();
                        o.setTime(o.getTime() + 24 * t * 60 * 60 * 1e3),
                            (n = "; expires=" + o.toUTCString());
                    }
                    var i = e + "=" + escape(r) + n + "; path=/";
                    l.crossSubdomain() &&
                        !1 !== a &&
                        !a &&
                        (a = l.nearestTLD()),
                        a && (i += "; domain=" + a),
                        (i += "; samesite=Lax");
                    var s = Storage.getItem(e);
                    return (
                        s && s == r
                            ? Wrappers.documentCookie(i)
                            : Storage.hasCookie(i)
                            ? Storage.setItem(e, r)
                            : (Storage.setItem(e, r),
                              Wrappers.documentCookie(i)),
                        i
                    );
                }),
                (l.eraseCookie = function (e, r) {
                    l.createCookie(e, "", -1, r), Storage.removeItem(e);
                }),
                (l.crDeleteOldCookies = function () {
                    l.eraseCookie("calltrk_referrer"),
                        l.eraseCookie("calltrk_landing"),
                        l.eraseCookie("calltrk_session_id");
                    var e = document.cookie.match(
                        /calltrk_session_swap_numbers_(\d+)=/g
                    );
                    if (e)
                        for (var r = 0; r < e.length; ++r) {
                            var t = /[0-9]+/g,
                                a = (e[r].match(t) || [])[0];
                            l.eraseCookie("calltrk_session_id_" + a),
                                l.eraseCookie(
                                    "calltrk_session_swap_numbers_" + a
                                );
                        }
                }),
                (l.readFreshCookie = function (e) {
                    var r = Storage.cookieValues(e);
                    return (
                        r.length <= 1 && Storage.setItem(e, r[0]), r[0] || null
                    );
                }),
                (l.readCookie = function (e) {
                    var r = Storage.getItem(e),
                        t = Storage.cookieValues(e);
                    return t.length <= 1 && !r
                        ? (Storage.setItem(e, t[0]), t[0] || null)
                        : r
                        ? (0 === t.length && l.createCookie(e, r), r)
                        : (l.crossSubdomain()
                              ? l.eraseCookie(e, !1)
                              : l.eraseCookie(e, l.nearestTLD()),
                          (t = Storage.cookieValues(e))[0] || null);
                }),
                (l.getSessionID = function (e) {
                    if (!e) {
                        if (CallTrkSwap._session_id)
                            return CallTrkSwap._session_id;
                        e = "calltrk_session_id";
                    }
                    var r = l.readCookie(e);
                    return (
                        r ||
                            CallTrk.eachNamespace(function (ns) {
                                r ||
                                    (r = l.readCookie(
                                        "calltrk_session_id_" + ns.id.toString()
                                    ));
                            }),
                        r || ((r = l.generateUUID()), l.createCookie(e, r)),
                        (CallTrkSwap._session_id = r)
                    );
                }),
                (l.getFormCaptureCookie = function (e) {
                    if (!e) {
                        if (l._fcid) return l._fcid;
                        e = "calltrk_fcid";
                    }
                    var r = l.readCookie(e);
                    return (
                        r || (r = l.generateUUID()),
                        l.createCookie(e, r),
                        (l._fcid = r)
                    );
                }),
                l
            );
        })(),
        Urls = (function () {
            function o() {}
            return (
                (o.getCurrentReferrer = function () {
                    var e = o.getURLParameter("utm_referrer");
                    return (
                        e || (e = Wrappers.documentReferrer()),
                        e || (e = "direct"),
                        e
                    );
                }),
                (o.getReferrerKey = function (e, r) {
                    var t;
                    e = e || "direct";
                    var a = /utm_medium=([cp]pc|paid_social|paid|.*_ad.*)/i;
                    if (r.match(/ndclid=/i)) t = "nextdoor_paid";
                    else if (
                        e.match(/doubleclick/i) ||
                        r.match(/dclid=|wbraid=|gbraid=/i)
                    )
                        t = "google_paid";
                    else if (
                        e.match(/google/i) &&
                        !e.match(/mail\.google\.com/i)
                    ) {
                        if (r.match(/gclid=/i)) return "google_paid";
                        t =
                            e.match(/googleadservices/i) ||
                            r.match(/utm_(medium|source)=[cp]pc/i) ||
                            r.match(/(matchtype|adposition)=/i)
                                ? "google_paid"
                                : "google_organic";
                    } else
                        t = r.match(/gclid=/i)
                            ? e.match(/(\/|\.)youtube\./i) ||
                              r.match(/utm_source=.*youtube.*/i)
                                ? "youtube_paid"
                                : r.match(/msclkid=/i)
                                ? "bing_paid"
                                : "google_paid"
                            : r.match(/msclkid=/i)
                            ? e.match(/(\/|\.)duckduckgo\./i) ||
                              r.match(/utm_source=.*duckduckgo.*/i)
                                ? "duckduckgo_paid"
                                : "bing_paid"
                            : e.match(/(\/|\.)bing\./i) ||
                              r.match(/utm_source=.*bing.*/i)
                            ? r.match(a) || r.match(/msclkid=/i)
                                ? "bing_paid"
                                : "bing_organic"
                            : e.match(/msn\.com/i)
                            ? "bing_paid"
                            : e.match(/yahoo/i) && !e.match(/mail\.yahoo\.com/i)
                            ? r.match(a)
                                ? "yahoo_paid"
                                : "yahoo_organic"
                            : r.match(/fb_ad_id=/i)
                            ? e.match(/(\/|\.)instagram\./i) ||
                              r.match(/utm_source=.*instagram.*/i)
                                ? "instagram_paid"
                                : "facebook_paid"
                            : r.match(/(fbclid=)/i) &&
                              e.match(/(\/|\.)instagram\./i)
                            ? r.match(a)
                                ? "instagram_paid"
                                : "instagram_organic"
                            : e.match(/(\/|\.)facebook\./i) ||
                              r.match(/(fbclid=|utm_source=.*facebook.*)/i)
                            ? r.match(a)
                                ? "facebook_paid"
                                : "facebook_organic"
                            : e.match(/(\/|\.)instagram\./i) ||
                              r.match(/utm_source=.*instagram.*/i)
                            ? r.match(a)
                                ? "instagram_paid"
                                : "instagram_organic"
                            : e.match(/(\/|\.)duckduckgo\./i) ||
                              r.match(/utm_source=.*duckduckgo.*/i)
                            ? r.match(a)
                                ? "duckduckgo_paid"
                                : "duckduckgo_organic"
                            : e.match(/(\/|\.)nextdoor\./i) ||
                              r.match(/utm_source=.*nextdoor.*/i)
                            ? r.match(a)
                                ? "nextdoor_paid"
                                : "nextdoor_organic"
                            : e.match(/(\/|\.)linkedin\./i) ||
                              r.match(/utm_source=.*linkedin.*/i)
                            ? r.match(a)
                                ? "linkedin_paid"
                                : "linkedin_organic"
                            : r.match(/ttclid=/i)
                            ? "tiktok_paid"
                            : e.match(/(\/|\.)tiktok\./i) ||
                              r.match(/utm_source=.*tiktok.*/i)
                            ? r.match(a)
                                ? "tiktok_paid"
                                : "tiktok_organic"
                            : e.match(/(\/|\.)twitter\./i) ||
                              r.match(/utm_source=.*twitter.*/i)
                            ? r.match(a)
                                ? "twitter_paid"
                                : "twitter_organic"
                            : e.match(/(\/|\.)pinterest\./i) ||
                              r.match(/utm_source=.*pinterest.*/i)
                            ? r.match(a)
                                ? "pinterest_paid"
                                : "pinterest_organic"
                            : e.match(/(\/|\.)spotify\./i) ||
                              r.match(/utm_source=.*spotify.*/i)
                            ? r.match(a)
                                ? "spotify_paid"
                                : "spotify_organic"
                            : e.match(/(\/|\.)yelp\./i) ||
                              r.match(/utm_source=.*yelp.*/i)
                            ? r.match(a) ||
                              r.match(
                                  /utm_(medium|source|campaign)=yelp_ad/i
                              ) ||
                              r.match(/campaign_code=yelp_ad/i)
                                ? "yelp_paid"
                                : "yelp_organic"
                            : e.match(/(\/|\.)youtube\./i) ||
                              r.match(/utm_source=.*youtube.*/i)
                            ? r.match(a)
                                ? "youtube_paid"
                                : "youtube_organic"
                            : "direct" === e
                            ? r.match(a) && r.match(/utm_source=.*google.*/i)
                                ? "google_paid"
                                : "direct"
                            : o.getReferrerDomain(e);
                    return t;
                }),
                (o.getReferrerDomain = function (e) {
                    var r = e.split("/")[2],
                        t = r.split(".");
                    return 2 < t.length
                        ? t[t.length - 2] + "." + t[t.length - 1]
                        : r;
                }),
                (o.getHostnameAndPath = function () {
                    var e = document.createElement("a");
                    e.href = Wrappers.windowLocation().href;
                    var r = e.pathname;
                    return (
                        0 !== r.indexOf("/") && (r = "/" + r), e.hostname + r
                    );
                }),
                (o.getURLParameter = function (e) {
                    var r = new RegExp(
                        "[?|&]" + e + "=([^&;]+?)(&|#|;|$)"
                    ).exec(Wrappers.windowLocation().search) || [null, ""];
                    return (
                        decodeURIComponent(r[1].replace(/\+/g, "%20")) || null
                    );
                }),
                (o.urlContainsParam = function (e) {
                    var r = "(\\?|&)" + e + "($|&|=)";
                    return Wrappers.windowLocation().href.match(r);
                }),
                (o.param = function (e, r, t) {
                    if ("string" == typeof e) return e;
                    for (var a in (r || (r = []), e)) {
                        var n = e[a];
                        e.hasOwnProperty(a) &&
                            n &&
                            (t &&
                                (a =
                                    t +
                                    "[" +
                                    (Polyfills.isArray(e) &&
                                    !Polyfills.isArray(e[0])
                                        ? ""
                                        : a) +
                                    "]"),
                            "object" != typeof n
                                ? r.push(
                                      encodeURIComponent(a) +
                                          "=" +
                                          encodeURIComponent(n)
                                  )
                                : o.param(n, r, a));
                    }
                    return t ? undefined : r.join("&");
                }),
                o
            );
        })(),
        Dom = (function () {
            function l() {}
            return (
                (l.injectCss = function () {
                    var e = document.documentElement,
                        r = "crjs";
                    e.classList ? e.classList.add(r) : (e.className += " " + r);
                    var t = document.createElement("style");
                    t.setAttribute("type", "text/css");
                    var a = ".crjs .phoneswap { visibility: hidden; }";
                    t.textContent !== undefined && (t.textContent = a);
                    var n = document.querySelector("head");
                    n && n.appendChild(t);
                }),
                (l.domEach = function (e, r) {
                    for (
                        var t = document.querySelectorAll(e), a = 0;
                        a < t.length;
                        a++
                    )
                        r(t[a]);
                }),
                (l.recurseDOM = function (e, r, t) {
                    for (var a, n = t || e, o = 1; n; ) {
                        var i = null;
                        !1 === r(n) ||
                            (n.nodeType !== o && !n.shadowRoot) ||
                            (i = n.shadowRoot
                                ? null === (a = n.shadowRoot) || void 0 === a
                                    ? void 0
                                    : a.firstChild
                                : n.firstChild),
                            n.nextSibling &&
                                n !== e &&
                                l.recurseDOM(e, r, n.nextSibling),
                            (n = i);
                    }
                }),
                (l.traverseDOM = function (i, e) {
                    var t = ["src", "srcset", "title", "phone"],
                        a =
                            /(\bclk[ng]\/(sms|tel|imessage))|(^(sms|tel|imessage))/i,
                        r = function (e, r, t) {
                            var a,
                                n =
                                    (a =
                                        "undefined" == typeof getComputedStyle
                                            ? e.currentStyle
                                            : getComputedStyle(e))[r] ||
                                    (t && a[t]);
                            if (n) {
                                var o = i(n);
                                null != o && (e.style[r] = o);
                            }
                        },
                        n = function (e, r) {
                            var t = e.getAttribute(r);
                            if (t) {
                                var a = i(t, r);
                                null != a && e.setAttribute(r, a);
                            }
                        },
                        o = function (e, r) {
                            for (var t = 0; t < e.length; t++) n(r, e[t]);
                        },
                        s = function (e) {
                            var r = e.getAttribute("href");
                            r && r.match(a) && n(e, "href");
                        };
                    l.domEach(".cr_image, .cr_image *", function (e) {
                        r(e, "background"), r(e, "backgroundImage");
                    }),
                        l.recurseDOM(e, function (e) {
                            switch (e.nodeType) {
                                case 1:
                                    if (
                                        ["SCRIPT", "NOSCRIPT"].includes(
                                            e.tagName
                                        ) ||
                                        e.hasAttribute("data-calltrk-noswap")
                                    )
                                        return !1;
                                    o(t, e), s(e);
                                    break;
                                case 3:
                                    var r = i(e.nodeValue);
                                    null != r &&
                                        (Wrappers.isDebug() &&
                                            (e.parentNode.className +=
                                                " calltrk-swap-occurred"),
                                        (e.nodeValue = r));
                            }
                        });
                }),
                (l.makePhoneSwapVisible = function () {
                    l.domEach(".phoneswap", function (e) {
                        e.style.visibility = "visible";
                    });
                }),
                (l.domTargets = function (e) {
                    var t,
                        a,
                        n = [],
                        o = /\D/g;
                    return (
                        l.traverseDOM(function (e) {
                            t = CallTrkSwap.stringTargets(e);
                            for (var r = 0; r < t.length; r++)
                                10 < (a = t[r].replace(o, "")).length &&
                                    (a = a.slice(a.length - 10)),
                                    -1 === Polyfills.indexOf(n, a) && n.push(a);
                            CallTrk.eachNamespace(function (ns) {
                                ns.exactTargetsIn(e, function (e) {
                                    n.push(e);
                                });
                            });
                        }, e),
                        n
                    );
                }),
                (l.startObserving = function () {
                    l.observer ||
                        "undefined" == typeof MutationObserver ||
                        ((l.observer = new MutationObserver(
                            l.mutationCallback
                        )),
                        l.observer.observe(document.body, {
                            childList: !0,
                            subtree: !0,
                        }));
                }),
                (l.stopObserving = function () {
                    l.observer &&
                        (l.observer.disconnect(), (l.observer = undefined));
                }),
                (l.mutationCallback = function (e) {
                    for (
                        var r = CallTrk.firstNamespace().session_observer,
                            t = !1,
                            a = 0;
                        a < e.length;
                        a++
                    )
                        for (
                            var n = e[a], o = 0;
                            o < n.addedNodes.length;
                            o++
                        ) {
                            var i = n.addedNodes[o];
                            CallTrkSwap.startSourceSwap(i),
                                r && (t = t || 0 < l.domTargets(i).length);
                        }
                    r &&
                        t &&
                        Performance.throttle(
                            "session_observer",
                            100,
                            function () {
                                CallTrkSwap.checkSessionSwap(!1);
                            }
                        );
                }),
                (l.visibleParent = function () {
                    var e;
                    try {
                        if (
                            window.self === window.parent ||
                            window.self.document ===
                                (null === (e = window.top) || void 0 === e
                                    ? void 0
                                    : e.document)
                        )
                            return !1;
                    } catch (r) {
                        return !1;
                    }
                    return !0;
                }),
                (l.waitingParent = function () {
                    try {
                        if ("loading" === window.parent.document.readyState)
                            return !0;
                    } catch (e) {
                        return !1;
                    }
                    return !1;
                }),
                (l.iframeAwareReady = function (e) {
                    l.readyRan = !1;
                    var r = function () {
                        l.readyRan ||
                            ((l.readyRan = !0), Polyfills.documentReady(e));
                    };
                    if (!(l.visibleParent() && l.waitingParent())) return r();
                    window.addEventListener("message", function (e) {
                        "calltrkReady" === e.data && r();
                    }),
                        "loading" !== window.parent.document.readyState && r(),
                        setTimeout(r, 2e3);
                }),
                (l.whenPageVisible = function (e) {
                    "prerender" !== document.visibilityState
                        ? e()
                        : document.addEventListener &&
                          document.addEventListener("visibilitychange", e, !1);
                }),
                (l.iframeConflict = function (e) {
                    if (!l.visibleParent()) return !1;
                    var r =
                        window.top &&
                        window.top.CallTrk &&
                        window.top.CallTrk._namespaces;
                    return r && 0 <= r.indexOf(e.toString());
                }),
                (l.broadcastReady = function () {
                    var e = window.frames;
                    if (0 !== e.length)
                        for (var r = 0; r < e.length; r++)
                            e[r].postMessage("calltrkReady", "*");
                }),
                (l.getScript = function (e, r, t) {
                    var a = document.createElement("script");
                    (a.type = "text/javascript"),
                        -1 !== e.indexOf("?") ? (e += "&") : (e += "?"),
                        (e += "t=" + new Date().getTime().toString()),
                        (e += "&" + Urls.param(r)),
                        Session.wpProxy() && t && (e = Session.proxyPath(e)),
                        (a.src = e),
                        document.body.appendChild(a);
                }),
                l
            );
        })(),
        Helpers = (function () {
            function n() {}
            return (
                (n.post = function (e) {
                    var r = new XMLHttpRequest();
                    return r.open("POST", e), r;
                }),
                (n.postScript = function (e, r, t) {
                    var a = n.post(e);
                    a.setRequestHeader("Content-Type", "text/plain"),
                        a.setRequestHeader("Accept", "application/json"),
                        (a.onload = function () {
                            var e = JSON.parse(a.response);
                            t(e);
                        }),
                        a.send(Polyfills.jsonify(r));
                }),
                (n.postCookies = function (e, r, t) {
                    var a = n.post(e);
                    a.setRequestHeader("Content-Type", "application/json"),
                        (a.onload = function () {
                            var e = a.status;
                            t(e);
                        }),
                        a.send(Polyfills.jsonify(r));
                }),
                (n.parseCookieResponse = function (e, r, t) {
                    204 !== e &&
                        ((window.crwpVer = 0),
                        Session.createCookie("calltrk_referrer", r),
                        Session.createCookie("calltrk_landing", t));
                }),
                (n.postWordpressCookies = function (r, t) {
                    var e = "/index.php?rest_route=/Calltrk/v1/store",
                        a = {
                            calltrk_referrer: r,
                            calltrk_landing: t,
                            calltrk_session_id: Session.getSessionID(),
                            domain: Session.nearestTLD(),
                            duration: CallTrk.firstNamespace().cookie_duration,
                        };
                    n.postCookies(e, a, function (e) {
                        n.parseCookieResponse(e, r, t);
                    });
                }),
                n
            );
        })(),
        IntegrationData = (function () {
            function IntegrationData() {}
            return (
                (IntegrationData.getGoogleContentExperimentCookies = function (
                    e
                ) {
                    if (e.google_experiments !== undefined)
                        return e.google_experiments;
                    var r;
                    if (
                        ((r = Session.readCookie("calltrk_google_experiments")
                            ? Session.readCookie("calltrk_google_experiments")
                            : ""),
                        Urls.getURLParameter("utm_expid"))
                    ) {
                        var t =
                            Urls.getURLParameter("utm_expid") +
                            "," +
                            Urls.getHostnameAndPath();
                        r.indexOf(t) < 0 && (r = "" !== r ? r + "|" + t : t),
                            Session.createCookie(
                                "calltrk_google_experiments",
                                r
                            );
                    }
                    return (e.google_experiments = r);
                }),
                (IntegrationData.getIntegrationData = function (r) {
                    var t = {},
                        a = {};
                    return (
                        CallTrk.eachNamespace(function (ns) {
                            if (!r || -1 < Polyfills.indexOf(r, ns.id)) {
                                var e = ns.getIntegrationData(a);
                                Polyfills.assign(t, e);
                            }
                        }),
                        t
                    );
                }),
                (IntegrationData.getInstanceIntegrationData = function (
                    cookieCache,
                    namespaceCookies,
                    namespaceScripts
                ) {
                    var multiswap = Session.isMulti(),
                        params = {
                            google_content_cookies:
                                IntegrationData.getGoogleContentExperimentCookies(
                                    cookieCache
                                ),
                        },
                        force_fetch = this.shouldForceFetchIntegrationData();
                    for (var reportName in namespaceCookies) {
                        var cookie = namespaceCookies[reportName],
                            value = void 0;
                        !force_fetch &&
                        multiswap &&
                        cookieCache[cookie] !== undefined
                            ? (params[reportName] = cookieCache[cookie])
                            : (multiswap
                                  ? ((value = force_fetch
                                        ? Session.readFreshCookie(cookie)
                                        : Session.readCookie(cookie)),
                                    (cookieCache[cookie] = value))
                                  : (value = Session.readFreshCookie(cookie)),
                              null !== value && (params[reportName] = value));
                    }
                    for (var reportAs in namespaceScripts) {
                        var code = namespaceScripts[reportAs];
                        try {
                            var rc = eval(code);
                            "object" != typeof rc ||
                                Polyfills.isArray(rc) ||
                                (rc = Urls.param(rc)),
                                (params[reportAs] = rc);
                        } catch (e) {}
                    }
                    return params;
                }),
                (IntegrationData.integrationRetry = function (e) {
                    var r = IntegrationData.getIntegrationData(e),
                        t = CallTrk.firstNamespace();
                    Polyfills.isEmptyObject(r) ||
                        ((r.uuid = Session.getSessionID()),
                        Session.isMulti() || (r.ids = e),
                        Dom.getScript(t.icapURL(), r));
                }),
                (IntegrationData.shouldForceFetchIntegrationData = function () {
                    var e,
                        r = new Date();
                    return (
                        (null ==
                            (e = Storage.getItem("integration-data-ttl")) ||
                            r.getTime() > e) &&
                        (this.setIntegrationTTL(r), !0)
                    );
                }),
                (IntegrationData.setIntegrationTTL = function (e) {
                    var r = 18e5,
                        t = e.getTime() + r;
                    return Storage.setItem("integration-data-ttl", t), t;
                }),
                IntegrationData
            );
        })(),
        Replacer = (function () {
            function f() {}
            return (
                (f.standardReplace = function (e, r, t) {
                    if (
                        (f._numberRegexCache || (f._numberRegexCache = {}),
                        !f._numberRegexCache[r])
                    ) {
                        var a = r.substring(0, 3),
                            n = r.substring(3, 6),
                            o = r.substring(6, 10),
                            i =
                                "(\\(?)" +
                                a +
                                "(\\))?" +
                                f.CHAR_SEP +
                                n +
                                f.CHAR_SEP +
                                o,
                            s =
                                "$1" +
                                t.substring(0, 3) +
                                "$2$3" +
                                t.substring(3, 6) +
                                "$4" +
                                t.substring(6, 10);
                        f._numberRegexCache[r] = [o, new RegExp(i, "g"), s];
                    }
                    var l = f._numberRegexCache[r];
                    if (-1 < e.indexOf(l[0])) {
                        if (Debug._isDebug) {
                            var c = e.match(l[1]);
                            if (c) {
                                var u = c[0],
                                    p = u.replace(l[1], l[2]);
                                Debug.doneSwaps[u] = p;
                            }
                        }
                        e = e.replace(l[1], l[2]);
                    }
                    return e;
                }),
                (f.replacementForPlainText = function (e, r) {
                    var t = r.substring(0, 3),
                        a = r.substring(3, 6),
                        n = r.substring(6, 10),
                        o = "(" + t + ") " + a + "-" + n,
                        i = t + "-" + a + "-" + n,
                        s = t + "." + a + "." + n;
                    return (e = (e = (e = e.replace("###phone###", o)).replace(
                        "###phone-dashes###",
                        i
                    )).replace("###phone-dots###", s));
                }),
                (f.CHAR_SEP = "([-. " + String.fromCharCode(160) + "]?)"),
                (f.NUM_REGEX = new RegExp(
                    "(\\(?)\\d{3}(\\))?" +
                        f.CHAR_SEP +
                        "\\d{3}" +
                        f.CHAR_SEP +
                        "\\d{4}\\b",
                    "g"
                )),
                (f.INTL_NUM_REGEX =
                    /[(+]?[(+]?(?:[\d][ \-.()\u202F\u00A0]{0,2}){8,21}[\d]/g),
                f
            );
        })(),
        NumberSwap = (function () {
            function e() {}
            return (
                (e.adjustExactFormat = function (e) {
                    var r = { advanced: {}, simple: {} };
                    for (var t in e)
                        if (-1 !== t.indexOf(",")) {
                            var a = t.split(","),
                                n = decodeURIComponent(a[0]),
                                o = decodeURIComponent(a[1]);
                            if (Polyfills.isArray(e[t])) {
                                var i = Replacer.replacementForPlainText(
                                    o,
                                    e[t][0]
                                );
                                r.advanced[i] = [
                                    "." === e[t][1][0] ? n : o,
                                    e[t][1],
                                ];
                            } else r.advanced[n] = [o, e[t]];
                        } else r.simple[t] = e[t];
                    return r;
                }),
                e
            );
        })(),
        PhoneNumbers = (function () {
            function e() {}
            return (
                (e.defaultNumberFormat = function (e) {
                    return (
                        "object" == typeof e &&
                            null !== e &&
                            (e = e.national_string),
                        e
                    );
                }),
                e
            );
        })(),
        Poll = (function () {
            function a() {}
            return (
                (a.pollSessionURL = function () {
                    var ns = CallTrk.firstNamespace();
                    return ns.buildURL("poll_session", {
                        multiswap_id: ns.multiswap_id,
                        host: ns.swap_session_host,
                        uuid: Session.getSessionID(),
                        multiswap_token: ns.multiswap_token,
                    });
                }),
                (a.pollSession = function () {
                    a.pollUnwatch();
                    var ns = CallTrk.firstNamespace(),
                        e = {},
                        r = Date.now(),
                        t = 0.9 * ns.session_poll_interval;
                    setTimeout(a.pollWatch, ns.session_poll_interval),
                        (CallTrkSwap.lastPoll &&
                            r - CallTrkSwap.lastPoll < t) ||
                            ((CallTrkSwap.lastPoll = r),
                            Session.isMulti() ||
                                (e.ids = Session.namespaceIds()),
                            (e.perf = Performance.runtimePerfData()),
                            Dom.getScript(a.pollSessionURL(), e));
                }),
                (a.pollInit = function () {
                    var e = CallTrk.firstNamespace().session_poll_interval;
                    CallTrkSwap.pollInitted ||
                        ((CallTrkSwap.pollInitted = !0),
                        setTimeout(a.pollWatch, e));
                }),
                (a.pollWatch = function () {
                    document.addEventListener("mousemove", a.pollSession),
                        document.addEventListener("keypress", a.pollSession),
                        window.addEventListener("focus", a.pollSession);
                }),
                (a.pollUnwatch = function () {
                    document.removeEventListener("mousemove", a.pollSession),
                        document.removeEventListener("keypress", a.pollSession),
                        window.removeEventListener("focus", a.pollSession);
                }),
                a
            );
        })(),
        ScanString = (function () {
            function u() {}
            return (
                (u.scan = function (o, n, i, e, a) {
                    var r = e !== undefined,
                        t = function (e, r) {
                            var t = u.intlStringTargets(o ? o.trim() : o);
                            if (0 < t.length) {
                                for (var a = "", n = 0; n < t.length; n++)
                                    a = r(i, t[n]);
                                return a;
                            }
                            return o;
                        },
                        s = function (e, r) {
                            if ("^" !== n.charAt(0))
                                return Replacer.standardReplace(
                                    o,
                                    n,
                                    e.national_string
                                );
                            if ("href" === a) return l(e.e164, r);
                            var t = u.findFormat(r, e.formats);
                            return l(null !== t ? t : e.national_string, r);
                        },
                        l = function (e, r) {
                            var t = r.replace(/\D/g, "");
                            if (n.slice(1) === t.slice(t.length - 8)) {
                                var a = new RegExp(u.escapeRegExp(r), "g");
                                Debug._isDebug && (Debug.doneSwaps[o] = e),
                                    (o = o.replace(a, e));
                            }
                            return o;
                        };
                    if (r || Polyfills.isArray(i)) {
                        if (-1 < o.indexOf(n)) {
                            var c = Replacer.replacementForPlainText(
                                r ? e : i[0],
                                r ? i : i[1]
                            );
                            Debug._isDebug && (Debug.doneSwaps[n] = c),
                                (o = o.replace(n, c));
                        }
                    } else
                        o =
                            "object" == typeof i && null !== i
                                ? t(i, s)
                                : "^" === n.charAt(0)
                                ? t(i, l)
                                : Replacer.standardReplace(o, n, i);
                    return o;
                }),
                (u.stringTargets = function (e) {
                    return (e && e.match(Replacer.NUM_REGEX)) || [];
                }),
                (u.intlStringTargets = function (e) {
                    return (e && e.match(Replacer.INTL_NUM_REGEX)) || [];
                }),
                (u.escapeRegExp = function (e) {
                    return e.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
                }),
                (u.findFormat = function (e, r) {
                    for (var t in r) if (u.isSameFormat(e, r[t])) return t;
                    return null;
                }),
                (u.isSameFormat = function (e, r) {
                    return new RegExp(r.slice(1, -1)).test(e);
                }),
                u
            );
        })(),
        CallTrkSwap = (function () {
            function CallTrkSwap(e) {
                (this.callback_scripts = {}),
                    Polyfills.assign(this, e),
                    window.CallTrk.pushNamespace("namespace_" + this.id, this);
            }
            return (
                Object.defineProperty(CallTrkSwap.prototype, "_perfData", {
                    get: function () {
                        return Performance.networkPerfData();
                    },
                    enumerable: !1,
                    configurable: !0,
                }),
                (CallTrkSwap.log = function (e, r) {
                    Wrappers.isDebug() &&
                        (r || ((r = e), (e = "swap")),
                        CallTrkSwap._log.push(e.toString() + ": " + r));
                }),
                (CallTrkSwap.prototype.log = function (e) {
                    CallTrkSwap.log(this.id, e);
                }),
                (CallTrkSwap.prototype.hasFormsOrChat = function () {
                    return this.chat_or_form_exists;
                }),
                (CallTrkSwap.prototype.run = function () {
                    (this.referrer = this.getReferrer()),
                        (this.landing = this.getLanding()),
                        (this.referrer_key = Urls.getReferrerKey(
                            this.referrer,
                            this.landing
                        )),
                        this.createReferrerAndLandingCookies(),
                        this.applyTrumpLandingPage(),
                        this.applyTrumpSources(),
                        this.getWidgetScripts(),
                        this.runCallbackScripts();
                }),
                (CallTrkSwap.prototype.runCallbackScripts = function () {
                    for (
                        var _i = 0, _a = Object.entries(this.callback_scripts);
                        _i < _a.length;
                        _i++
                    ) {
                        var _b = _a[_i];
                        _b[0];
                        var script = _b[1];
                        eval(script);
                    }
                }),
                (CallTrkSwap.prototype.applyTrumpSources = function () {
                    if (this.trump_sources) {
                        var e = Urls.getReferrerKey(
                            Wrappers.documentReferrer(),
                            Wrappers.documentURL()
                        );
                        Polyfills.contains(
                            ["google_paid", "yahoo_paid", "bing_paid"],
                            e
                        ) &&
                            (Session.crDeleteOldCookies(),
                            delete CallTrkSwap._referrer,
                            delete CallTrkSwap._landing,
                            (CallTrkSwap._referrerAndLandingCookiesCreated =
                                !1),
                            (this.referrer = Wrappers.documentReferrer()),
                            (this.landing = Wrappers.documentURL()),
                            this.createReferrerAndLandingCookies(),
                            (this.referrer_key = e));
                    }
                }),
                (CallTrkSwap.prototype.applyTrumpLandingPage = function () {
                    if (this.trump_landing_param) {
                        var e = this.trump_landing_page_param;
                        Urls.urlContainsParam(e) &&
                            (Session.crDeleteOldCookies(),
                            delete CallTrkSwap._referrer,
                            delete CallTrkSwap._landing,
                            (CallTrkSwap._referrerAndLandingCookiesCreated =
                                !1),
                            (this.referrer = Wrappers.documentReferrer()),
                            (this.landing = Wrappers.documentURL()),
                            this.createReferrerAndLandingCookies(),
                            (this.referrer_key = Urls.getReferrerKey(
                                this.referrer,
                                this.landing
                            )));
                    }
                }),
                (CallTrkSwap.prototype.exactTargetsIn = function (e, r) {
                    for (
                        var t = 0;
                        t < this.session_exact_targets.length;
                        t++
                    ) {
                        var a = this.session_exact_targets[t];
                        0 <= e.indexOf(a) && r(this.session_exact_targets[t]);
                    }
                }),
                (CallTrkSwap.swapCleanup = function () {
                    delete Replacer._numberRegexCache,
                        CallTrk.eachNamespace(function (ns) {
                            ns._storedSwapCache = null;
                        });
                }),
                (CallTrkSwap.mergeStoredSwaps = function (e) {
                    var r = e.global;
                    CallTrk.eachNamespace(function (ns) {
                        r && ns.mergeStoredSwaps(r),
                            e[ns.id] && ns.mergeStoredSwaps(e[ns.id]);
                    });
                }),
                (CallTrkSwap.mergeUnassignedSwaps = function (e) {
                    var r = e.global;
                    CallTrk.eachNamespace(function (ns) {
                        r && ns.mergeUnassignedSwaps(r),
                            e[ns.id] && ns.mergeUnassignedSwaps(e[ns.id]);
                    });
                }),
                (CallTrkSwap.prototype.mergeStoredSwaps = function (e) {
                    var r = this.getStoredSwaps();
                    for (var t in e) e[t] ? (r[t] = e[t]) : r[t] && delete r[t];
                    this.assigns(r);
                }),
                (CallTrkSwap.prototype.mergeUnassignedSwaps = function (e) {
                    var r = this.getUnassignedSwaps();
                    for (var t in e)
                        if (e[t]) {
                            var a = r.indexOf(t);
                            -1 < a && r.splice(a, 1);
                        } else -1 === r.lastIndexOf(t) && r.push(t);
                    this.unassigns(r);
                }),
                (CallTrkSwap.prototype.getStoredSwaps = function () {
                    var e = this.assigns();
                    return e || {};
                }),
                (CallTrkSwap.prototype.getUnassignedSwaps = function () {
                    var e = this.unassigns();
                    return e || [];
                }),
                (CallTrkSwap.prototype.unassigns = function (e) {
                    return e
                        ? (CallTrkSwap._unassigns = e)
                        : CallTrkSwap._unassigns;
                }),
                (CallTrkSwap.prototype.assigns = function (e) {
                    var r = this.id + "-assigns-" + Session.getSessionID();
                    return e ? Storage.setItem(r, e) : Storage.getItem(r);
                }),
                (CallTrkSwap.prototype.swapString = function (a, n) {
                    var o = this;
                    return (
                        this._storedSwapCache ||
                            (this._storedSwapCache =
                                NumberSwap.adjustExactFormat(
                                    this.getStoredSwaps()
                                )),
                        ["advanced", "simple"].forEach(function (e) {
                            for (var r in o._storedSwapCache[e]) {
                                var t = o._storedSwapCache[e][r];
                                a = ScanString.scan(a, r, t, undefined, n);
                            }
                        }, this),
                        a
                    );
                }),
                (CallTrkSwap.startSourceSwap = function (e) {
                    e = e || document.body;
                    var c = CallTrkSwap.matchingSourceTrackers(),
                        r = function (e, r) {
                            for (var t = e, a = 0; a < c.length; a++) {
                                var n = PhoneNumbers.defaultNumberFormat(
                                    c[a].number
                                );
                                for (var o in c[a].advanced_swap_targets) {
                                    var i = c[a].advanced_swap_targets[o];
                                    t = ScanString.scan(t, o, n, i, r);
                                }
                                n = c[a].number;
                                for (
                                    var s = 0;
                                    s < c[a].swap_targets.length;
                                    s++
                                ) {
                                    var l = c[a].swap_targets[s];
                                    t = ScanString.scan(t, l, n, undefined, r);
                                }
                            }
                            if (t !== e) return t;
                        };
                    if (0 !== c.length) {
                        var t = r(document.title);
                        if (
                            (t && (document.title = t),
                            Dom.traverseDOM(r, e),
                            window.Cufon)
                        )
                            try {
                                window.Cufon.refresh();
                            } catch (a) {}
                    }
                }),
                (CallTrkSwap.startSessionSwap = function (e, r) {
                    var n = this,
                        o = ["advanced", "simple"],
                        i = NumberSwap.adjustExactFormat(e),
                        t = document.title;
                    for (var a in ((r = r || document.body),
                    o.forEach(function (e) {
                        for (var r in i[e]) t = ScanString.scan(t, r, i[e][r]);
                    }, this),
                    CallTrk._namespaceObjs))
                        t = CallTrk._namespaceObjs[a].swapString(t);
                    if (
                        (t !== document.title && (document.title = t),
                        Dom.traverseDOM(function (e, t) {
                            var a = e;
                            for (var r in (Debug._isDebug &&
                                Debug.foundTargets.push(e),
                            o.forEach(function (e) {
                                for (var r in i[e])
                                    a = ScanString.scan(
                                        a,
                                        r,
                                        i[e][r],
                                        undefined,
                                        t
                                    );
                            }, n),
                            CallTrk._namespaceObjs))
                                a = CallTrk._namespaceObjs[r].swapString(a, t);
                            if (a !== e) return a;
                        }, r),
                        CallTrkSwap.swapCleanup(),
                        window.Cufon)
                    )
                        try {
                            window.Cufon.refresh();
                        } catch (s) {}
                    CallTrk.firstNamespace().mutation_observer &&
                        Dom.startObserving(),
                        Dom.makePhoneSwapVisible();
                }),
                (CallTrkSwap.checkSessionSwap = function (e, r) {
                    r = r || document.body;
                    var t = {},
                        a = null,
                        n = !1,
                        o = !1;
                    if (
                        (CallTrk.eachNamespace(function (ns) {
                            ns.hasSessionTracker() &&
                                ((o = !0),
                                (a = ns.session_poll_interval),
                                (n = n || ns.session_polling));
                        }),
                        o)
                    ) {
                        for (
                            var i = Dom.domTargets(r), s = !1, l = e, c = 0;
                            c < i.length;
                            c++
                        )
                            (t[i[c]] = null),
                                Debug._isDebug && Debug.foundTargets.push(i[c]);
                        CallTrk.eachNamespace(function (ns) {
                            var e = ns.checkSessionSwap(t);
                            s = s || e;
                        }),
                            s && CallTrkSwap.startSessionSwap({}, r),
                            CallTrk.eachNamespace(function (ns) {
                                l = l || ns.checkUnassignedSwaps(t);
                            }),
                            l &&
                                (CallTrk.firstNamespace().getSecondScript(t, e),
                                a && n && Poll.pollInit());
                    }
                    CallTrk.firstNamespace().mutation_observer &&
                        Dom.startObserving(),
                        Polyfills.isEmptyObject(t) &&
                            Dom.makePhoneSwapVisible();
                }),
                (CallTrkSwap.prototype.checkUnassignedSwaps = function (e) {
                    for (
                        var r = this.getUnassignedSwaps(),
                            t = this.assigns() || {},
                            a = Object.keys(e),
                            n = 0;
                        n < a.length;
                        n++
                    ) {
                        var o = a[n];
                        if (-1 === r.indexOf(o) && !(o in t)) return !0;
                    }
                    return !1;
                }),
                (CallTrkSwap.checkFormsOrChat = function () {
                    var e = !1,
                        r = !1;
                    CallTrk.eachNamespace(function (ns) {
                        (e = e || ns.hasSessionTracker()),
                            (r = r || ns.hasFormsOrChat());
                    }),
                        !e &&
                            r &&
                            CallTrk.firstNamespace().getSecondScript({}, !0);
                }),
                (CallTrkSwap.prototype.checkSessionSwap = function (e) {
                    var r = this.getStoredSwaps(),
                        t = !1;
                    for (var a in r) {
                        var n = r[a];
                        if (!e[a])
                            if (null === e[a]) (e[a] = n), (t = !0);
                            else if (-1 !== a.indexOf(",")) {
                                var o = a.split(","),
                                    i = decodeURIComponent(o[0]);
                                null === e[i] &&
                                    (delete e[i], (e[a] = n), (t = !0));
                            }
                    }
                    return t;
                }),
                (CallTrkSwap.prototype.youTubeMatch = function (e) {
                    return (
                        "youtube_paid" === this.referrer_key &&
                        Polyfills.contains(e, "google_paid")
                    );
                }),
                (CallTrkSwap.prototype.hasReferrerMatch = function (e) {
                    if (this.youTubeMatch(e)) return !0;
                    if (Polyfills.contains(e, this.referrer_key)) return !0;
                    var r = !!this.referrer,
                        t = "direct" === this.referrer || "" === this.referrer;
                    if (!r || t) return !1;
                    var a = Urls.getReferrerDomain(this.referrer);
                    return Polyfills.contains(e, a);
                }),
                (CallTrkSwap.matchingSourceTrackers = function () {
                    var e = [];
                    return (
                        CallTrk.eachNamespace(function (ns) {
                            ns.is_bot ||
                                e.push.apply(e, ns.matchingSourceTrackers());
                        }),
                        e
                    );
                }),
                (CallTrkSwap.prototype.matchingSourceTrackers = function () {
                    for (
                        var e = [], r = 0;
                        r < this.source_trackers.length;
                        r++
                    ) {
                        var t = this.source_trackers[r];
                        if ("all" !== t.referrer_tracking_source)
                            -1 !==
                                t.referrer_tracking_source.indexOf("landing") &&
                            -1 !==
                                this.landing.indexOf(t.landing_tracking_source)
                                ? e.push(t)
                                : this.hasReferrerMatch(t.referrer_keys) &&
                                  e.push(t);
                        else e.push(t);
                    }
                    return e;
                }),
                (CallTrkSwap.prototype.domlessSessionSwap = function (e, r) {
                    if (this.hasSessionTracker() && e && 0 !== e.length) {
                        for (var t = {}, a = 0; a < e.length; a++)
                            t[e[a]] = null;
                        (CallTrkSwap.swapCallback = r),
                            this.getSecondScript(t, !1, !0);
                    } else r({});
                }),
                (CallTrkSwap.prototype.hasSessionTracker = function () {
                    return (
                        this.session_number_target_exists ||
                        0 < this.session_exact_targets.length
                    );
                }),
                (CallTrkSwap.swapEntry = function () {
                    var e = CallTrkSwap;
                    e.startSwaps(),
                        window.Squarespace &&
                            window.Squarespace.onInitialize &&
                            window.Squarespace.onInitialize(
                                window.Y,
                                function () {
                                    e.startSwaps();
                                }
                            );
                }),
                (CallTrkSwap.startSwaps = function () {
                    document.removeEventListener &&
                        document.removeEventListener(
                            "visibilitychange",
                            CallTrkSwap.swapEntry,
                            !1
                        ),
                        Dom.iframeAwareReady(function () {
                            var e = CallTrkSwap;
                            (Debug.doneSwaps = {}),
                                (Debug.foundTargets = []),
                                e.startSourceSwap(),
                                e.checkSessionSwap(!0),
                                e.checkFormsOrChat(),
                                Dom.broadcastReady();
                        });
                }),
                (CallTrkSwap.prototype.buildURL = function (e, r) {
                    var t = this.endpoints[e];
                    for (var a in r) t = t.replace("$" + a, r[a]);
                    return (
                        this.force_https &&
                            !t.match(/https:/) &&
                            (t = "https:" + t),
                        Session.wpProxy() && (t = Session.proxyPath(t)),
                        t &&
                            t.indexOf("app.calltrk") &&
                            t.indexOf("form_capture") &&
                            (t = t.replace("app.calltrk", "trk.calltrk")),
                        t
                    );
                }),
                (CallTrkSwap.prototype.getIntegrationData = function (e) {
                    var r = this.data_collection_config.cookies,
                        t = this.data_collection_config.scripts;
                    return IntegrationData.getInstanceIntegrationData(e, r, t);
                }),
                (CallTrkSwap.prototype.icapURL = function () {
                    return this.buildURL("integration_retry", {
                        multiswap_id: this.multiswap_id,
                        multiswap_token: this.multiswap_token,
                        version: "12",
                        host: this.swap_session_host,
                    });
                }),
                (CallTrkSwap.prototype.swapSessionURL = function () {
                    return this.buildURL("multiswap_session", {
                        multiswap_id: this.multiswap_id,
                        host: this.swap_session_host,
                        version: "12",
                        multiswap_token: this.multiswap_token,
                    });
                }),
                (CallTrkSwap.prototype.createReferrerAndLandingCookies =
                    function () {
                        CallTrkSwap._referrerAndLandingCookiesCreated ||
                            (Session.hasWordpressCookies()
                                ? Helpers.postWordpressCookies(
                                      this.referrer,
                                      this.landing
                                  )
                                : (Session.createCookie(
                                      "calltrk_referrer",
                                      this.referrer
                                  ),
                                  Session.createCookie(
                                      "calltrk_landing",
                                      this.landing
                                  )),
                            (CallTrkSwap._referrerAndLandingCookiesCreated =
                                !0));
                    }),
                (CallTrkSwap.prototype.getReferrer = function () {
                    if (CallTrkSwap._referrer) return CallTrkSwap._referrer;
                    var e = Session.readCookie("calltrk_referrer");
                    return (
                        e || (e = Urls.getCurrentReferrer()),
                        (CallTrkSwap._referrer = e)
                    );
                }),
                (CallTrkSwap.prototype.getLanding = function () {
                    if (CallTrkSwap._landing) return CallTrkSwap._landing;
                    var e = Session.readCookie("calltrk_landing");
                    return (
                        e || (e = Wrappers.documentURL()),
                        (CallTrkSwap._landing = e)
                    );
                }),
                (CallTrkSwap.prototype.getSecondScript = function (e, r, t) {
                    var a = {
                        cid: Urls.getURLParameter("cid"),
                        uuid: Session.getSessionID(),
                        ref: this.getCurrentReferrer(),
                        landing: Wrappers.documentURL(),
                        user_agent: navigator.userAgent,
                        record_pageview: r && !Dom.iframeConflict(this.id),
                        domless: t,
                        swaps: [],
                        all_formats: !0,
                    };
                    Session.isMulti() || (a.ids = Session.namespaceIds());
                    var n = IntegrationData.getIntegrationData();
                    Polyfills.assign(a, n);
                    var o = {};
                    for (var i in e) {
                        var s = e[i] || "",
                            l = s;
                        "object" == typeof s && (l = s.national_string),
                            l || (o[i] = null),
                            a.swaps.push(i + "=" + l);
                    }
                    if (
                        (Object.keys(o).length && this.mergeUnassignedSwaps(o),
                        "withCredentials" in new XMLHttpRequest())
                    ) {
                        (a.perf = Performance.networkPerfData()),
                            Performance.reset();
                        var c = this.swapSessionURL().replace(/\.js$/, ".json");
                        Helpers.postScript(c, a, function (e) {
                            CallTrkSwap.parseSessionSwap(e);
                        });
                    } else Dom.getScript(this.swapSessionURL(), a);
                }),
                (CallTrkSwap.parseSessionSwap = function (e) {
                    !0 === e.domless
                        ? CallTrkSwap.swapCallback(e.a)
                        : !0 === e.number_assignment &&
                          (CallTrkSwap.mergeStoredSwaps(e.a),
                          CallTrkSwap.mergeUnassignedSwaps(e.a),
                          CallTrkSwap.startSessionSwap(e.r)),
                        Dom.makePhoneSwapVisible(),
                        !0 === e.integration_retry &&
                            IntegrationData.integrationRetry(
                                e.integration_retries
                            );
                }),
                (CallTrkSwap.prototype.getWidgetScripts = function () {
                    var r = this,
                        e = function (e) {
                            r.endpoints[e] &&
                                -1 === CallTrk.appendedScripts.indexOf(e) &&
                                (Dom.getScript(r.endpoints[e], {}, !0),
                                CallTrk.appendedScripts.push(e));
                        };
                    Polyfills.documentReady(function () {
                        r.endpoints.chat &&
                            Dom.getScript(r.endpoints.chat, {}, !0),
                            r.endpoints.contact &&
                                !r.endpoints.chat &&
                                Dom.getScript(r.endpoints.contact, {}, !0),
                            r.endpoints.external_chats &&
                                Dom.getScript(
                                    r.endpoints.external_chats,
                                    {},
                                    !0
                                ),
                            e("custom_forms"),
                            e("external_forms");
                    });
                }),
                (CallTrkSwap.firstNamespace = function () {
                    return CallTrk.firstNamespace();
                }),
                (CallTrkSwap.generateUUID = function () {
                    return Session.generateUUID();
                }),
                (CallTrkSwap.getSessionID = function () {
                    for (var e = [], r = 0; r < arguments.length; r++)
                        e[r] = arguments[r];
                    return Session.getSessionID.apply(Session, e);
                }),
                (CallTrkSwap.readCookie = function () {
                    for (var e = [], r = 0; r < arguments.length; r++)
                        e[r] = arguments[r];
                    return Session.readCookie.apply(Session, e);
                }),
                (CallTrkSwap.createCookie = function () {
                    for (var e = [], r = 0; r < arguments.length; r++)
                        e[r] = arguments[r];
                    return Session.createCookie.apply(Session, e);
                }),
                (CallTrkSwap.eraseCookie = function () {
                    for (var e = [], r = 0; r < arguments.length; r++)
                        e[r] = arguments[r];
                    return Session.eraseCookie.apply(Session, e);
                }),
                (CallTrkSwap.getFormCaptureCookie = function () {
                    for (var e = [], r = 0; r < arguments.length; r++)
                        e[r] = arguments[r];
                    return Session.getFormCaptureCookie.apply(Session, e);
                }),
                (CallTrkSwap.getReferrerKey = function () {
                    for (var e = [], r = 0; r < arguments.length; r++)
                        e[r] = arguments[r];
                    return Urls.getReferrerKey.apply(Urls, e);
                }),
                (CallTrkSwap.isMulti = function () {
                    for (var e = [], r = 0; r < arguments.length; r++)
                        e[r] = arguments[r];
                    return Session.isMulti.apply(Session, e);
                }),
                (CallTrkSwap.stringTargets = function () {
                    for (var e = [], r = 0; r < arguments.length; r++)
                        e[r] = arguments[r];
                    return ScanString.stringTargets.apply(ScanString, e);
                }),
                (CallTrkSwap.intlStringTargets = function () {
                    for (var e = [], r = 0; r < arguments.length; r++)
                        e[r] = arguments[r];
                    return ScanString.intlStringTargets.apply(ScanString, e);
                }),
                (CallTrkSwap.whenPageVisible = function () {
                    for (var e = [], r = 0; r < arguments.length; r++)
                        e[r] = arguments[r];
                    return Dom.whenPageVisible.apply(Dom, e);
                }),
                (CallTrkSwap.prototype.iframeConflict = function () {
                    return Dom.iframeConflict(this.id);
                }),
                (CallTrkSwap.prototype.getCurrentReferrer = function () {
                    return Urls.getCurrentReferrer();
                }),
                (CallTrkSwap.prototype.getHostnameAndPath = function () {
                    return Urls.getHostnameAndPath();
                }),
                (CallTrkSwap.prototype.getURLParameter = function () {
                    for (var e = [], r = 0; r < arguments.length; r++)
                        e[r] = arguments[r];
                    return Urls.getURLParameter.apply(Urls, e);
                }),
                (CallTrkSwap.prototype.getGoogleContentExperimentCookies =
                    function () {
                        for (var e = [], r = 0; r < arguments.length; r++)
                            e[r] = arguments[r];
                        return IntegrationData.getGoogleContentExperimentCookies.apply(
                            IntegrationData,
                            e
                        );
                    }),
                (CallTrkSwap.prototype.postWordpressCookies = function () {
                    for (var e = [], r = 0; r < arguments.length; r++)
                        e[r] = arguments[r];
                    return Helpers.postWordpressCookies.apply(Helpers, e);
                }),
                Object.defineProperty(CallTrkSwap, "_isDebug", {
                    get: function () {
                        return Debug._isDebug;
                    },
                    set: function (e) {
                        Debug._isDebug = e;
                    },
                    enumerable: !1,
                    configurable: !0,
                }),
                Object.defineProperty(CallTrkSwap, "foundTargets", {
                    get: function () {
                        return Debug.foundTargets;
                    },
                    set: function (e) {
                        Debug.foundTargets = e;
                    },
                    enumerable: !1,
                    configurable: !0,
                }),
                Object.defineProperty(CallTrkSwap, "doneSwaps", {
                    get: function () {
                        return Debug.doneSwaps;
                    },
                    set: function (e) {
                        Debug.doneSwaps = e;
                    },
                    enumerable: !1,
                    configurable: !0,
                }),
                (CallTrkSwap.scanString = function () {
                    for (var e = [], r = 0; r < arguments.length; r++)
                        e[r] = arguments[r];
                    return ScanString.scan.apply(ScanString, e);
                }),
                (CallTrkSwap._log = []),
                (CallTrkSwap._unassigns = []),
                (CallTrkSwap.imports = {
                    CallTrk: CallTrk,
                    Debug: Debug,
                    Dom: Dom,
                    Helpers: Helpers,
                    IntegrationData: IntegrationData,
                    NumberSwap: NumberSwap,
                    Performance: Performance,
                    PhoneNumbers: PhoneNumbers,
                    Poll: Poll,
                    Polyfills: Polyfills,
                    Replacer: Replacer,
                    ScanString: ScanString,
                    Session: Session,
                    Storage: Storage,
                    Urls: Urls,
                    Wrappers: Wrappers,
                }),
                CallTrkSwap
            );
        })(),
        CallTrk = (function () {
            function s() {}
            return (
                (s.pushNamespace = function (ns, e) {
                    for (var r = s._namespaces, t = 0; t < r.length; ++t)
                        if (r[t] === ns) return;
                    r.push(ns), e && (s._namespaceObjs[ns] = e);
                }),
                (s.eachNamespace = function (e) {
                    for (var r = s._namespaces, t = 0; t < r.length; ++t) {
                        var ns = r[t];
                        e(s._namespaceObjs[ns]);
                    }
                }),
                (s.prototype.findNamespace = function (e) {
                    for (var r = s._namespaces, t = 0; t < r.length; ++t) {
                        var ns = r[t];
                        if (e(s._namespaceObjs[ns])) return ns;
                    }
                    return null;
                }),
                (s.firstNamespace = function () {
                    return s._namespaceObjs[s._namespaces[0]];
                }),
                (s.swap = function (e) {
                    (Debug.doneSwaps = {}),
                        (Debug.foundTargets = []),
                        (e = e || document.body),
                        CallTrkSwap.startSourceSwap(e),
                        CallTrkSwap.checkSessionSwap(!1, e);
                }),
                (s.getSwapNumbers = function (e, t) {
                    Polyfills.isArray(e) || (e = [e]);
                    for (
                        var r = s.knownSwapAssignments(),
                            a = s._namespaces[0],
                            ns = s._namespaceObjs[a],
                            n = {},
                            o = 0;
                        o < e.length;
                        o++
                    ) {
                        var i = e[o];
                        r[i] &&
                            ((n[i] = PhoneNumbers.defaultNumberFormat(r[i])),
                            e.splice(o--, 1));
                    }
                    return (
                        0 === e.length
                            ? t(n)
                            : ns.domlessSessionSwap(e, function (e) {
                                  for (var r in (e = (e && e[ns.id]) || {}))
                                      n[r] = PhoneNumbers.defaultNumberFormat(
                                          e[r]
                                      );
                                  t(n);
                              }),
                        n
                    );
                }),
                (s.knownSwapAssignments = function () {
                    var t = {};
                    s.eachNamespace(function (ns) {
                        var e = ns.getStoredSwaps();
                        for (var r in e) t[r] = e[r];
                    });
                    for (
                        var e = CallTrkSwap.matchingSourceTrackers(), r = 0;
                        r < e.length;
                        r++
                    )
                        for (
                            var a = e[r], n = 0;
                            n < a.swap_targets.length;
                            n++
                        ) {
                            var o = a.swap_targets[n];
                            t[o] || (t[o] = a.number);
                        }
                    return t;
                }),
                (s._namespaces = []),
                (s._namespaceObjs = {}),
                (s.appendedScripts = []),
                (s.typescript = !0),
                s
            );
        })();
    Dom.injectCss(),
        Performance.networkPerfData(),
        (Debug._isDebug = Debug._debugEnabled()),
        (window.CallTrkSwap = window.CallTrkSwap || CallTrkSwap),
        (window.CallTrk = window.CallTrk || CallTrk);
})();
new CallTrkSwap({
    id: 510456811,
    cookie_duration: 365,
    cross_subdomain: true,
    session_poll_interval: 60000.0,
    session_polling: true,
    session_observer: true,
    access_key: "7bda3313a52c1474cd0e",
    form_capture_config: {
        enabled: false,
        url_scope: null,
        urls: [],
        source: null,
    },
    trump_landing_param: false,
    trump_landing_page_param: null,
    trump_sources: false,
    mutation_observer: true,
    is_bot: false,
    force_https: true,
    data_collection_config: {
        cookies: {
            ga: "_ga",
            utma: "__utma",
            utmb: "__utmb",
            utmc: "__utmc",
            utmv: "__utmv",
            utmx: "__utmx",
            utmz: "__utmz",
        },
        scripts: {},
    },
    callback_scripts: {},
    source_trackers: [
        {
            id: "TRK153a3d745bf547ddaaa92aa1cbbfe293",
            referrer_tracking_source: "landing_url",
            landing_tracking_source:
                "http://thedanielslawfirm.com/houston-family-attorney",
            referrer_keys: ["landing_url"],
            swap_targets: ["3467031234"],
            advanced_swap_targets: {},
            number: {
                national: "(281) 378-6453",
                national_string: "2813786453",
                international: "+1 281-378-6453",
                e164: "+12813786453",
                formats: {},
            },
        },
        {
            id: "TRKda25681a9f30496fa30fe825c9998d83",
            referrer_tracking_source: "google_my_business",
            landing_tracking_source: null,
            referrer_keys: ["google_my", "google_business"],
            swap_targets: ["3467031234"],
            advanced_swap_targets: {},
            number: {
                national: "(346) 236-0230",
                national_string: "3462360230",
                international: "+1 346-236-0230",
                e164: "+13462360230",
                formats: {},
            },
        },
        {
            id: "TRK0ea14d23263045c6be369f486566b877",
            referrer_tracking_source: "google_organic",
            landing_tracking_source: null,
            referrer_keys: ["google_organic"],
            swap_targets: ["3467031234"],
            advanced_swap_targets: {},
            number: {
                national: "(346) 214-2521",
                national_string: "3462142521",
                international: "+1 346-214-2521",
                e164: "+13462142521",
                formats: {},
            },
        },
        {
            id: "TRKab511108b98843eabf8839a6b90026b3",
            referrer_tracking_source: "all",
            landing_tracking_source: null,
            referrer_keys: ["all"],
            swap_targets: ["3467031234"],
            advanced_swap_targets: {},
            number: {
                national: "(346) 818-2637",
                national_string: "3468182637",
                international: "+1 346-818-2637",
                e164: "+13468182637",
                formats: {},
            },
        },
    ],
    endpoints: {
        multiswap_session:
            "//js.callrail.com/group/0/7bda3313a52c1474cd0e/12/swap_session.js",
        integration_retry:
            "//js.callrail.com/group/0/7bda3313a52c1474cd0e/12/icap.js",
        form_capture:
            "//app.callrail.com/companies/510456811/7bda3313a52c1474cd0e/12/form_capture.js",
        poll_session:
            "//js.callrail.com/group/0/7bda3313a52c1474cd0e/$uuid/poll.js",
        cr_form: "//js.callrail.com/forms/$formid",
    },
    swap_session_host: "js.callrail.com",
    session_number_target_exists: true,
    session_exact_targets: [],
    chat_or_form_exists: null,
}).run(),
    CallTrk.installed ||
        ((CallTrk.installed = !0),
        CallTrkSwap.whenPageVisible(function () {
            CallTrkSwap.swapEntry();
        }));

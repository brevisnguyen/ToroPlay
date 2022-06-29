! function() {
    function t() {
        try {
            var e = window.crypto || window.msCrypto;
            if (e && e.getRandomValues) return e.getRandomValues(new Uint32Array(1))[0].toString(36)
        } catch (e) {}
        return Math.random().toString(36).slice(2, 9)
    }

    function R(e) {
        for (var a = ""; a.length < e;) a += t();
        return a.slice(0, e)
    }

    function B(e) {
        if (e) {
            if (/vast/.test(e)) return 0;
            if (/googima/.test(e)) return 1;
            if (/freewheel/.test(e)) return 2;
            if (/dai/.test(e)) return 3
        }
        return -1
    }

    function r(e) {
        return /^[a-zA-Z0-9]{8}$/.test(e)
    }

    function i(e) {
        var a = !(1 < arguments.length && void 0 !== arguments[1]) || arguments[1];
        if ("number" != typeof e) return null;
        var t = e / 1e3;
        return a ? Math.round(t) : t
    }

    function u(e, a) {
        return e + "-" + a
    }

    function d(e, a) {
        return a.split(".").reduce(function(e, a) {
            return e ? e[a] : void 0
        }, e)
    }

    function s(e) {
        return !(!e.width || !e.naturalWidth)
    }
    var M = 4,
        j = {
            pro: 1,
            premium: 2,
            ads: 3,
            invalid: M,
            enterprise: 6,
            trial: 7,
            platinum: 8,
            starter: 9,
            business: 10,
            developer: 11
        },
        O = {
            viewable: 2
        },
        e = "DATA_EVENT_PLAY",
        a = "DATA_EVENT_META",
        n = "DATA_EVENT_LEVELS",
        o = "DATA_EVENT_FIRST_FRAME",
        m = 128,
        l = ["auto", "initial choice"],
        c = ["playlistItem", "playAttempt", "time", "adBreakEnd"];
    var p = "error",
        g = "ana",
        v = "t",
        f = "prp",
        y = "vsh",
        b = "paf",
        h = "bs",
        k = "fs",
        w = "fc",
        I = "aa",
        D = "gab",
        L = "ph",
        S = "n",
        T = "e",
        P = "sa",
        E = "i",
        A = "as",
        C = "ar",
        x = "ers",
        G = "err";
    var _, V = (_ = function() {
            var e = navigator.plugins;
            if (e && "object" == typeof e["Shockwave Flash"]) {
                var a = e["Shockwave Flash"].description;
                if (a) return a
            }
            if (void 0 !== window.ActiveXObject) try {
                var t = new window.ActiveXObject("ShockwaveFlash.ShockwaveFlash");
                if (t) {
                    var n = t.GetVariable("$version");
                    if (n) return n
                }
            } catch (e) {}
            return ""
        }().replace(/\D+(\d+\.?\d*).*/, "$1"), function() {
            return _
        }),
        N = R(12);
    var q = void 0;
    try {
        q = window.localStorage
    } catch (e) {}
    var F = "hidden" in document ? function() {
        return !document.hidden
    } : "webkitHidden" in document ? function() {
        return !document.webkitHidden
    } : function() {
        return !0
    };

    function Q(e, a) {
        var t = " " + a + " ";
        return 1 === e.nodeType && 0 <= (" " + e.className + " ").replace(/[\t\r\n\f]/g, " ").indexOf(t)
    }
    var U = a;

    function K(e) {
        var a = e.getContainer().querySelector("video");
        return a && a.currentTime ? a.currentTime : e.getPosition()
    }

    function z(a) {
        try {
            return a.getPlaylistItem()
        } catch (e) {
            var t = a.getPlaylistIndex();
            return a.getConfig().playlist[t] || null
        }
    }

    function W(e) {
        if ("function" == typeof e.getProvider) {
            var a = e.getProvider();
            return a ? a.name : ""
        }
        return ""
    }
    var H = void 0;

    function X(e) {
        var a = 1 < arguments.length && void 0 !== arguments[1] && arguments[1],
            t = e.getVisualQuality(),
            n = void 0;
        if (t && t.level) {
            var r = "string" == typeof t.mode ? "auto" === t.mode : null;
            n = {
                width: t.level.width,
                height: t.level.height,
                bitrate: i(t.level.bitrate),
                reason: t.reason,
                adaptiveBitrateMode: r
            }
        } else n = {
            width: null,
            height: null,
            bitrate: null,
            reason: null,
            adaptiveBitrateMode: null
        };
        return H && !a || (H = n), n
    }

    function Y(e) {
        var a = e.external.playerAPI,
            t = e.meta.playbackEvents,
            n = a.getDuration();
        if (n <= 0) {
            var r = t[U];
            r && (n = r.duration)
        }
        return 0 | n
    }
    var $ = {
            UNKNOWN: 999,
            IAB: 0
        },
        J = {
            noBid: 0,
            bid: 1,
            timeout: 2,
            invalid: 3,
            abort: 4,
            error: 5
        },
        Z = {
            numCompanions: -1,
            podCount: 0,
            podIndex: 0,
            linear: -1,
            vastVersion: -1,
            adSystem: null,
            adCreativeType: null,
            adposition: -1,
            tagdomain: null,
            position: void 0,
            previousQuartile: 0,
            duration: void 0,
            witem: 1,
            wcount: 1,
            preload: void 0,
            adMediaFileURL: void 0
        },
        ee = /^IAB(\d+(?:-\d+)?)$/,
        ae = {
            adRequest: "ar",
            adImpression: "i",
            adSkipped: "s",
            adError: "ae",
            adBidResponse: "abr",
            adClick: "c",
            adLoaded: "al",
            adViewableImpression: "vi",
            adBidRequest: "abq"
        },
        te = ["adStarted", "adMeta"],
        ne = ["adTime", "adClick"],
        re = ["adBreakStart", "adMeta", "adImpression", "adViewableImpression", "adPlay", "adPause", "adTime", "adCompanions", "adClick", "adSkipped", "adComplete", "adError"],
        ie = {
            dfp: 0,
            jwp: 1,
            jwpdfp: 2,
            jwpspotx: 3
        },
        oe = ["id", "type", "pubid", "result", "code", "winner", "priceInCents", "timeForBidResponse", "requestId", "cacheKey"],
        de = ["1", "yes", "true"];
    var le = "jwp-global-frame",
        ue = "i.jwpsrv.com",
        ce = {
            PARAM_ANALYTICS_TOKEN: "aid",
            PARAM_MEDIA_ID: "id",
            EMBED_ID: "emi",
            ITEM_ID: "pli",
            PARAM_EXTERNAL_ID: "xid",
            PARAM_XID_ALGORITHM_VERSION: "xav",
            PARAM_PLAYER_VERSION: "pv",
            PARAM_TRACKER_VERSION: "tv"
        };

    function se(e, a, t) {
        a.parentNode && a.parentNode.removeChild(a), a.src = t, e.appendChild(a)
    }

    function pe() {
        var e = document.getElementById(le);
        return e || ((e = document.createElement("iframe")).setAttribute("id", le), e.style.display = "none"), e
    }

    function fe(e, a, t) {
        var n = {
                PARAM_ANALYTICS_TOKEN: a.analyticsID,
                PARAM_MEDIA_ID: a.mediaID,
                EMBED_ID: a.embedID,
                ITEM_ID: a.playID,
                PARAM_EXTERNAL_ID: a.externalID,
                PARAM_XID_ALGORITHM_VERSION: a.xidAlgorithmVersion,
                PARAM_PLAYER_VERSION: a.playerVersion,
                PARAM_TRACKER_VERSION: a.trackerVersion
            },
            r = Object.keys(n).reduce(function(e, a) {
                var t = n[a];
                return null == t ? e : e + (e.length ? "&" : "") + ce[a] + "=" + encodeURIComponent(t)
            }, "");
        se(e, pe(), t + "?" + r)
    }

    function me(e) {
        if (e.temporaryGCID.gcidIframeShouldBeRequested = !1, function(a) {
                if (a.temporaryGCID.gcidError = null, !a.browser.allowUserTracking) return !1;
                var e = a.external.playerAPI;
                try {
                    var t = void 0,
                        n = void 0;
                    if (e.getEnvironment) {
                        var r = e.getEnvironment();
                        t = r.Browser.facebook, n = r.OS.iOS
                    } else t = e.utils.isFacebook(), n = e.utils.isIOS();
                    return a.temporaryGCID.gcidIsOnFacebook = t, a.temporaryGCID.gcidIsOnIOS = n, !(t && n)
                } catch (e) {
                    return !(a.temporaryGCID.gcidError = !0)
                }
            }(e) && (e.playlistItemData.mediaId || e.playlistItemData.externalId)) {
            var a = e.external.div,
                t = {
                    analyticsID: e.accountData.analyticsID,
                    mediaID: e.playlistItemData.mediaId,
                    embedID: e.staticPlayerData.embedID,
                    playID: e.playlistItemData.itemId,
                    externalID: e.playlistItemData.externalId,
                    xidAlgorithmVersion: e.meta.xidAlgorithmVersion,
                    playerVersion: e.staticPlayerData.playerVersion,
                    trackerVersion: "3.11.0"
                },
                n = document.querySelector('[src*="' + ue + '"]'),
                r = e.trackingState.gcidURL;
            e.temporaryGCID.gcidIframeShouldBeRequested = !0, !n || n.complete || s(n) ? setTimeout(function() {
                return fe(a, t, r)
            }) : (i = n, o = a, d = t, l = r, u = void 0, c = setInterval(function() {
                (s(i) || i.complete) && (clearInterval(c), clearTimeout(u), fe(o, d, l))
            }, 250), u = setTimeout(function() {
                clearInterval(c), fe(o, d, l)
            }, 1e3))
        }
        var i, o, d, l, u, c
    }
    var ge = Object.assign || function(e) {
        for (var a = arguments.length, t = Array(1 < a ? a - 1 : 0), n = 1; n < a; n++) t[n - 1] = arguments[n];
        return t.reduce(function(e, a) {
            return function(a, t) {
                if (!t) return a;
                return Object.keys(t).forEach(function(e) {
                    a[e] = t[e]
                }), a
            }(e, a)
        }, e)
    };
    var ve = function() {
            function e() {
                ! function(e, a) {
                    if (!(e instanceof a)) throw new TypeError("Cannot call a class as a function")
                }(this, e), this._pingTracker = {}
            }
            return e.prototype.canSendPing = function(e) {
                return !this._pingTracker[e]
            }, e.prototype.setPingSent = function(e) {
                this._pingTracker[e] = !0
            }, e.prototype.resetAll = function() {
                this._pingTracker = {}
            }, e.prototype.resetKey = function(e) {
                delete this._pingTracker[e]
            }, e
        }(),
        ye = 0;

    function be(e, a, t) {
        var n, r, i = a.sdkplatform ? parseInt(a.sdkplatform, 10) : void 0,
            o = e.getConfig(),
            d = (o || {}).advertising || {},
            l = ye += 1,
            u = "doNotTrack",
            c = null == (n = u) || -1 === de.indexOf(n.toString()),
            s = (e.utils.isFileProtocol && e.utils.isFileProtocol() ? "https:" : "") + "//g.jwpsrv.com/g/gcid-0.1.0.html",
            p = void 0,
            f = void 0;
        if (c) {
            var m = function() {
                if (!q) return {
                    localID: null,
                    storageAvailable: "fail"
                };
                var e = q.jwplayerLocalId;
                if (e) return {
                    localID: e,
                    storageAvailable: "read"
                };
                try {
                    return q.jwplayerLocalId = R(12), {
                        localID: q.jwplayerLocalId,
                        storageAvailable: "set"
                    }
                } catch (e) {
                    return {
                        localID: null,
                        storageAvailable: "fail"
                    }
                }
            }();
            p = m.localID, f = m.storageAvailable
        } else q && q.removeItem("jwplayerLocalId"), r = s, se(t, pe(), r + "?notrack");
        var g, v, y, b, h, k, w, I, D, S, T, P = (g = document.querySelector("html")) ? g.getAttribute("lang") : null,
            E = window.matchMedia && window.matchMedia("(display-mode: standalone)").matches || !0 === window.navigator.standalone,
            A = function() {
                try {
                    if (window.top !== window.self) return window.top.document.referrer
                } catch (e) {
                    return null
                }
                return document.referrer
            }(),
            C = o.defaultPlaybackRate || 1,
            x = B(d.client);
        return e.getPlugin && e.getPlugin("related"), {
            external: {
                playerAPI: e,
                div: t,
                utils: e.utils
            },
            playerData: {
                setupTime: -1,
                visualQuality: X(e),
                numAutoVisualQualityChange: 0,
                lastErrorCode: {},
                defaultPlaybackRate: C,
                playerConfig: {
                    visibility: -1,
                    bandwidthEstimate: -1,
                    floatingState: !1
                },
                floatingConfigured: !(!o.floating || o.floating.disabled),
                playerSize: {
                    width: 0,
                    height: 0,
                    bucket: 0
                },
                localization: {
                    language: o.language,
                    numIntlKeys: "object" == typeof o.intl ? Object.keys(o.intl).length : null,
                    numLocalKeys: "object" == typeof o.localization ? Object.keys(o.localization).length : null
                },
                contextualEmbed: !!o.contextual,
                playbackMode: null
            },
            staticPlayerData: (w = e, I = a, D = i, T = {
                playerVersion: (S = w.version, S.split("+")[0]),
                sdkPlatform: I.sdkplatform || 0,
                embedID: R(12)
            }, D && (T.sdkVersion = I.iossdkversion), T),
            casting: !1,
            accountData: function(e, a) {
                var t = 0,
                    n = void 0;
                if (e) {
                    var r = new a(e),
                        i = r.edition();
                    (t = j[i] || 0) !== M && (n = r.token())
                }
                return n || (n = "_"), {
                    analyticsID: n,
                    edition: t
                }
            }(o.key, e.utils.key),
            configData: (v = o, b = window.jwplayer && window.jwplayer.defaults || {}, h = v.related, k = {
                playerHosting: v[L] || b[L] || 0,
                playerConfigKey: v.pid,
                abTestConfig: v.pad,
                skinName: v.skin,
                advertisingBlockType: (y = v, y.advertising ? y.advertising.outstream ? 2 : 1 : 0),
                sharingEnabled: !!v.sharing,
                castingBlockPresent: !!v.cast,
                gaBlockPresent: !!v.ga,
                autostartConfig: !!v.autostart,
                visualPlaylist: !1 !== v.visualplaylist,
                displayDescription: !1 !== v.displaydescription,
                posterImagePresent: !!v.image,
                playbackRateControlsSet: !!v.playbackRateControls,
                relatedPluginConfigPresent: !!h
            }, v.autostart in O && (k.autostartConfig = O[v.autostart]), h && (k.relatedPluginFeedFile = h.recommendations || h.file), k),
            browser: {
                langAttr: P,
                isPageStandalone: E,
                docReferrer: A,
                storage: {
                    localID: p,
                    storageAvailable: f,
                    doNotTrackProperty: u
                },
                pageData: function(e) {
                    if (e) return {
                        pageViewId: N
                    };
                    var a = "",
                        t = "",
                        n = window.top !== window.self;
                    if (n) {
                        a = document.referrer;
                        try {
                            a = a || window.top.location.href, t = window.top.document.title
                        } catch (e) {}
                    }
                    var r = document.querySelector('meta[property="og:title"]'),
                        i = void 0;
                    return r && (i = r.getAttribute("content")), {
                        pageURL: a || window.location.href,
                        pageTitle: t || document.title,
                        inIframe: n,
                        flashVersion: V(),
                        pageViewId: N,
                        pageOGTitle: i
                    }
                }(i),
                allowUserTracking: c
            },
            meta: {
                debug: !0 === a.debug,
                setupCount: ye,
                nthPlayer: l,
                playbackEvents: {},
                playbackSent: void 0,
                playbackTracking: {
                    trackingSegment: void 0,
                    playedSeconds: 0,
                    viewablePlayedSeconds: 0,
                    audiblePlayedSeconds: 0,
                    playedSecondsTotal: 0,
                    previousTime: null,
                    segmentReceived: !1,
                    segmentsEncrypted: !1,
                    playItemCount: 0,
                    playSessionSequence: 0,
                    prevPlaybackRate: C,
                    retTimeWatched: 0,
                    normalizedTime: -1,
                    elapsedSeconds: 0,
                    viewableElapsedSeconds: 0,
                    audibleElapsedSeconds: 0,
                    currentPosition: 0,
                    thresholdCrossed: 0,
                    sendSetTimeEvents: o.setTimeEvents || !1
                },
                bufferedPings: [],
                seekTracking: {
                    numTrackedSeeks: 0,
                    videoStartDragTime: 0,
                    dragStartTime: 0,
                    seekDebounceTimeout: null,
                    lastTargetTime: 0
                },
                previousBufferTimes: {},
                lastEvent: "",
                lastBucket: "",
                eventPreAbandonment: void 0,
                playerState: "idle",
                playerStateDuration: 0,
                playerRemoved: !1,
                pingLimiters: {
                    playlistItem: new ve
                }
            },
            playlistItemData: {
                ready: void 0,
                item: {},
                drm: "",
                index: 0,
                itemId: "",
                mediaId: "",
                playReason: "",
                duration: 0
            },
            related: {
                shownReason: null,
                nextShownReason: null,
                sendHoverPing: null,
                feedId: null,
                feedInstanceId: null,
                feedType: null,
                onClickSetting: -1,
                feedInterface: null,
                idsShown: [],
                thumbnailIdsShown: [],
                pinnedCount: -1,
                page: -1,
                autotimerLength: -1,
                pinSetId: -1,
                advanceTarget: null,
                ordinalClicked: -1
            },
            sharing: {
                shareMethod: null,
                shareReferrer: function(e) {
                    if (!e) return null;
                    var a = e.match(/[?&]jwsource=([^&]+)/);
                    return a ? decodeURIComponent(a[1]) : null
                }(window.location.search)
            },
            ads: {
                adEventData: ge({}, Z),
                advertisingConfig: d,
                adClient: x,
                adScheduleId: d.adscheduleid,
                VAST_URL_SAMPLE_RATE: 6e-5,
                adBreakTracking: -1 !== x ? {
                    shouldTrack: !1,
                    adBreakCount: 0
                } : null,
                headerBiddingData: {},
                headerBiddingCacheData: {
                    bidder: null,
                    cacheKey: null
                },
                watchedPastSkipPoint: null,
                jwAdErrorCode: null,
                currentQuartile: null,
                creativeId: null,
                adTitle: null
            },
            errors: {
                SAMPLE_RATE: .02,
                NUM_ERRORS_PER_SESSION: 1,
                numberEventsSent: 0
            },
            trackingState: {
                pageLoaded: null,
                queue: [],
                onping: "function" == typeof a.onping ? a.onping : null,
                images: [],
                boundFlushQueue: null,
                gcidURL: s
            },
            temporaryGCID: {
                gcidError: null,
                gcidIsOnFacebook: null,
                gcidIsOnIOS: null,
                gcidIframeShouldBeRequested: null
            }
        }
    }

    function he(e, a) {
        var t, n, r, i, o, d, l, u;
        for (t = 3 & e.length, n = e.length - t, r = a, o = 3432918353, d = 461845907, u = 0; u < n;) l = 255 & e.charCodeAt(u) | (255 & e.charCodeAt(++u)) << 8 | (255 & e.charCodeAt(++u)) << 16 | (255 & e.charCodeAt(++u)) << 24, ++u, r = 27492 + (65535 & (i = 5 * (65535 & (r = (r ^= l = (65535 & (l = (l = (65535 & l) * o + (((l >>> 16) * o & 65535) << 16) & 4294967295) << 15 | l >>> 17)) * d + (((l >>> 16) * d & 65535) << 16) & 4294967295) << 13 | r >>> 19)) + ((5 * (r >>> 16) & 65535) << 16) & 4294967295)) + ((58964 + (i >>> 16) & 65535) << 16);
        switch (l = 0, t) {
            case 3:
                l ^= (255 & e.charCodeAt(u + 2)) << 16;
            case 2:
                l ^= (255 & e.charCodeAt(u + 1)) << 8;
            case 1:
                r ^= l = (65535 & (l = (l = (65535 & (l ^= 255 & e.charCodeAt(u))) * o + (((l >>> 16) * o & 65535) << 16) & 4294967295) << 15 | l >>> 17)) * d + (((l >>> 16) * d & 65535) << 16) & 4294967295
        }
        return r ^= e.length, r = 2246822507 * (65535 & (r ^= r >>> 16)) + ((2246822507 * (r >>> 16) & 65535) << 16) & 4294967295, r = 3266489909 * (65535 & (r ^= r >>> 13)) + ((3266489909 * (r >>> 16) & 65535) << 16) & 4294967295, (r ^= r >>> 16) >>> 0
    }

    function ke(e) {
        return De(e, "feedid")
    }

    function we(e) {
        return De(e, "feed_instance_id")
    }

    function Ie(e) {
        return e ? e.pin_set_id : null
    }

    function De(e, a) {
        return e ? (e.feedData || {})[a] || e[a] : null
    }

    function Se(e) {
        if (!e) return null;
        var a, t, n = e.mediaid;
        return r(n) ? n : (a = e.file, r(n = (t = /.*\/(?:manifests|videos)\/([a-zA-Z0-9]{8})[\.-].*/.exec(a)) && 2 === t.length ? t[1] : null) ? n : null)
    }

    function Te(e) {
        return e ? e.title : null
    }
    var Pe = {
            sgB1CN8sEeW9HgpVuA4vVw: !1,
            "QHh6WglVEeWjwQp+lcGdIw": !0,
            "4lTGrhE9EeWepAp+lcGdIw": !0,
            "98DmWsGzEeSdAQ4AfQhyIQ": !0,
            "xNaEVFs+Eea6EAY3v_uBow": !0,
            KvvTdq_lEeSqTw4AfQhyIQ: !1
        },
        Ee = 1;

    function Ae(e, a) {
        var t = void 0;
        Pe[e.accountData.analyticsID] && (t = function(e, a) {
            var t = Te(a);
            if (t) return function(e, a) {
                e.meta.xidAlgorithmVersion = 1;
                var t = he(a, Ee),
                    n = he(a + a, Ee);
                return "01_" + t + n
            }(e, t)
        }(e, a));
        var n = t || a.externalId;
        (e.playlistItemData.externalId = n) && !e.meta.xidAlgorithmVersion && (e.meta.xidAlgorithmVersion = 0)
    }

    function Ce(e) {
        return e === 1 / 0 ? 1 / 0 : (e |= 0) <= 0 ? 0 : e < 30 ? 1 : e < 60 ? 4 : e < 180 ? 8 : e < 300 ? 16 : 32
    }
    var xe = {
            events: {
                "aa-jwplayer6": {
                    code: "aa",
                    bucket: "jwplayer6",
                    parameterGroups: ["global"],
                    pingSpecificParameters: ["fct", "fed", "fid", "fin", "fns", "fsid", "fsr", "ft", "mu", "os", "psd"],
                    filters: ["missingFeedID"]
                },
                "abr-clienta": {
                    code: "abr",
                    bucket: "clienta",
                    parameterGroups: ["global", "adGlobal", "headerBidding"],
                    pingSpecificParameters: ["apr"]
                },
                "abq-clienta": {
                    code: "abq",
                    bucket: "clienta",
                    parameterGroups: ["global", "adGlobal", "headerBidding"],
                    pingSpecificParameters: ["apr"]
                },
                "ae-clienta": {
                    code: "ae",
                    bucket: "clienta",
                    parameterGroups: ["global", "adGlobal", "headerBidding"],
                    pingSpecificParameters: ["apr", "atu", "ca", "cao", "ec", "ad", "aec", "ct", "mfc", "tal", "uav"],
                    filters: ["missingAdScheduleID"]
                },
                "al-clienta": {
                    code: "al",
                    bucket: "clienta",
                    parameterGroups: ["global", "adGlobal"],
                    pingSpecificParameters: ["apr", "tal"],
                    filters: ["missingAdScheduleID"]
                },
                "ana-jwplayer6": {
                    code: "ana",
                    bucket: "jwplayer6",
                    parameterGroups: ["sessionParamsOnly"],
                    filters: ["missingMediaOrExternalID"]
                },
                "ar-clienta": {
                    code: "ar",
                    bucket: "clienta",
                    parameterGroups: ["global", "adGlobal"],
                    pingSpecificParameters: ["apr"],
                    filters: ["missingAdScheduleID"]
                },
                "bs-jwplayer6": {
                    code: "bs",
                    bucket: "jwplayer6",
                    parameterGroups: ["global"],
                    pingSpecificParameters: ["fed", "fid", "ft", "mu", "os"],
                    filters: ["missingFeedID"]
                },
                "c-clienta": {
                    code: "c",
                    bucket: "clienta",
                    parameterGroups: ["global", "adGlobal"],
                    pingSpecificParameters: ["ad", "adc", "al", "ct", "du", "qt", "srf", "tw", "vv", "uav"]
                },
                "e-jwplayer6": {
                    code: "e",
                    bucket: "jwplayer6",
                    parameterGroups: ["global"],
                    pingSpecificParameters: ["ab", "cb", "cme", "dd", "dnt", "flc", "fv", "ga", "lng", "mk", "mu", "pad", "pbc", "pd", "pdr", "plng", "plt", "pni", "pnl", "po", "pogt", "ptid", "r", "rf", "sn", "sp", "srf", "st", "vp", "vrt"],
                    filters: ["missingMediaOrExternalID"]
                },
                "err-error": {
                    code: "err",
                    bucket: "error",
                    parameterGroups: ["global"],
                    pingSpecificParameters: ["cme", "erc", "pogt"]
                },
                "ers-error": {
                    code: "ers",
                    bucket: "error",
                    parameterGroups: ["global"],
                    pingSpecificParameters: ["cme", "erc", "flc", "pogt"]
                },
                "fc-jwplayer6": {
                    code: "fc",
                    bucket: "jwplayer6",
                    parameterGroups: ["global"],
                    pingSpecificParameters: ["fct", "fed", "fid", "fin", "fns", "fpg", "fsid", "fsr", "ft", "mu", "oc", "os", "psd", "srf", "stid"],
                    filters: ["missingFeedID"]
                },
                "fs-jwplayer6": {
                    code: "fs",
                    bucket: "jwplayer6",
                    parameterGroups: ["global"],
                    pingSpecificParameters: ["fed", "fid", "fin", "fis", "fns", "fpc", "fpg", "fsid", "fsr", "ft", "mu", "os", "rat", "srf", "tis", "vfi"],
                    filters: ["missingFeedID"]
                },
                "gab-jwplayer6": {
                    code: "gab",
                    bucket: "jwplayer6",
                    parameterGroups: ["global"],
                    pingSpecificParameters: ["abid", "abpr", "apid", "ati", "erc", "fls", "lae", "pbs", "pcp", "prs", "prsd", "srf", "ti", "tps", "ubc", "vti"],
                    filters: ["missingMediaOrExternalID"]
                },
                "i-clienta": {
                    code: "i",
                    bucket: "clienta",
                    parameterGroups: ["global", "adGlobal", "headerBidding"],
                    pingSpecificParameters: ["ad", "apr", "adc", "adt", "al", "amu", "ca", "cao", "cid", "ct", "du", "fed", "fid", "mfc", "psd", "tal", "vv", "uav"]
                },
                "idt-g": {
                    code: "idt",
                    bucket: "g",
                    parameterGroups: ["sessionParamsOnly"],
                    pingSpecificParameters: ["gid"],
                    filters: ["missingMediaOrExternalID"]
                },
                "pa-jwplayer6": {
                    code: "pa",
                    bucket: "jwplayer6",
                    parameterGroups: ["global"],
                    pingSpecificParameters: ["ab", "abid", "abm", "apid", "bwe", "cme", "dnt", "fed", "fid", "flc", "lng", "mu", "pd", "pdr", "plng", "pni", "pnl", "pogt", "pr", "psd", "sbr", "tb", "vd", "vh", "vw"],
                    filters: ["missingMediaOrExternalID"]
                },
                "paf-error": {
                    code: "paf",
                    bucket: "error",
                    parameterGroups: ["global"],
                    pingSpecificParameters: ["abm", "bwe", "erc", "fed", "fid", "mu", "pd", "pr", "psd", "sbr", "tb", "vd", "vh", "vw"],
                    filters: ["missingMediaOrExternalID"]
                },
                "prp-jwplayer6": {
                    code: "prp",
                    bucket: "jwplayer6",
                    parameterGroups: ["global"],
                    pingSpecificParameters: ["tc"],
                    filters: ["missingMediaOrExternalID"]
                },
                "pru-jwplayer6": {
                    code: "pru",
                    bucket: "jwplayer6",
                    parameterGroups: ["global"],
                    pingSpecificParameters: ["ppr"],
                    filters: ["missingMediaOrExternalID"]
                },
                "ret-jwplayer6": {
                    code: "ret",
                    bucket: "jwplayer6",
                    parameterGroups: ["global"],
                    pingSpecificParameters: ["abm", "ati", "avc", "bwe", "etw", "fed", "fid", "fls", "mu", "pbs", "pr", "q", "sbr", "srf", "ubc", "vh", "vr", "vti", "vw"],
                    filters: ["missingMediaOrExternalID"]
                },
                "s-jwplayer6": {
                    code: "s",
                    bucket: "jwplayer6",
                    parameterGroups: ["global"],
                    pingSpecificParameters: ["abid", "abm", "apid", "bwe", "cct", "dnt", "drm", "fed", "ff", "fid", "l", "lng", "mk", "mu", "pd", "pdr", "plng", "pni", "pnl", "pr", "psd", "q", "qcr", "sbr", "sp", "srf", "tb", "tt", "vd", "vh", "vs", "vrt", "vr", "vw"]
                },
                "s-clienta": {
                    code: "s",
                    bucket: "clienta",
                    parameterGroups: ["global", "adGlobal"],
                    pingSpecificParameters: ["ad", "adc", "al", "atps", "ct", "du", "qt", "tw", "vv", "uav"]
                },
                "t-jwplayer6": {
                    code: "t",
                    bucket: "jwplayer6",
                    parameterGroups: ["global"],
                    pingSpecificParameters: ["abm", "ati", "avc", "bwe", "fed", "fid", "fls", "mu", "pbs", "pcp", "pw", "q", "sbr", "ti", "ubi", "vh", "vr", "vti", "vw"],
                    filters: ["missingMediaOrExternalID"]
                },
                "v-clienta": {
                    code: "v",
                    bucket: "clienta",
                    parameterGroups: ["global", "adGlobal"],
                    pingSpecificParameters: ["ad", "adc", "al", "ct", "du", "qt", "vv", "uav"],
                    filters: ["missingAdScheduleID"]
                },
                "vcae-clienta": {
                    code: "vcae",
                    bucket: "clienta",
                    parameterGroups: ["adSessionParamsOnly"],
                    pingSpecificParameters: ["abt", "aid", "aml", "ask", "c", "emi", "flpc", "pli", "vcb", "vck", "vpb"]
                },
                "vci-clienta": {
                    code: "vci",
                    bucket: "clienta",
                    parameterGroups: ["adSessionParamsOnly"],
                    pingSpecificParameters: ["abt", "aid", "aml", "ask", "c", "emi", "flpc", "pli", "vcb", "vck", "vpb"]
                },
                "vi-clienta": {
                    code: "vi",
                    bucket: "clienta",
                    parameterGroups: ["global", "adGlobal"],
                    filters: ["missingAdScheduleID"]
                },
                "vqc-jwplayer6": {
                    code: "vqc",
                    bucket: "jwplayer6",
                    parameterGroups: ["global"],
                    pingSpecificParameters: ["abm", "avc", "bwe", "qcr", "sbr", "tb", "vw", "vh"],
                    filters: ["missingMediaOrExternalID"]
                },
                "vs-jwplayer6": {
                    code: "vs",
                    bucket: "jwplayer6",
                    parameterGroups: ["global"],
                    pingSpecificParameters: ["cvl", "sdt", "tvl", "vso"],
                    filters: ["missingMediaOrExternalID"]
                },
                "vsh-jwplayer6": {
                    code: "vsh",
                    bucket: "jwplayer6",
                    parameterGroups: ["global"],
                    pingSpecificParameters: ["pcp", "srf", "stg"],
                    filters: ["missingMediaOrExternalID"]
                }
            },
            paramGroups: {
                global: {
                    members: ["abc", "abt", "aid", "ask", "at", "c", "ccp", "cp", "d", "eb", "ed", "emi", "gerr", "gfb", "gifr", "gios", "i", "id", "lid", "lsa", "mt", "pbd", "pbr", "pgi", "ph", "pid", "pii", "pl", "plc", "pli", "pp", "ppm", "prc", "ps", "pss", "pt", "pu", "pv", "pyc", "s", "sdk", "stc", "stpe", "sv", "t", "tul", "tv", "vb", "vi", "vl", "wd", "xav", "xid"],
                    groupName: "global"
                },
                adGlobal: {
                    members: ["ab", "abid", "abo", "adi", "apid", "awi", "awc", "p", "pc", "pi", "pr", "sko", "tmid", "vu"],
                    groupName: "adGlobal"
                },
                adSessionParamsOnly: {
                    members: ["abid", "apid"],
                    groupName: "adSessionParamsOnly"
                },
                sessionParamsOnly: {
                    members: ["aid", "emi", "id", "pli", "pv", "tv", "xav", "xid"],
                    groupName: "sessionParamsOnly"
                },
                headerBidding: {
                    members: ["afbb", "afbi", "afbp", "afbt", "afbw", "aml", "asxb", "asxi", "asxp", "asxt", "asxw", "flpc", "frid", "hbec", "vpb"],
                    groupName: "headerBidding"
                }
            }
        },
        Re = {
            missingMediaOrExternalID: function(e) {
                return !e.playlistItemData.mediaId && !e.playlistItemData.externalId
            },
            missingAdScheduleID: function(e) {
                return !e.ads.adScheduleId
            },
            missingAdDuration: function(e) {
                return !e.ads.adEventData.duration
            },
            missingFeedID: function(e) {
                return !e.related.feedId
            }
        };
    var Be = {
        abc: function(e) {
            var a = e.ads.adBreakTracking;
            if (a) return a.adBreakCount
        },
        abt: function(e) {
            var a = e.external.playerAPI.getConfig(),
                t = a.ab;
            if (t && t.tests) return Object.keys(t.tests).map(function(e) {
                return t.getSelected(e, a).join(",")
            }).filter(function(e) {
                return e
            }).join(",")
        },
        aid: function(e) {
            return e.accountData.analyticsID
        },
        ask: function(e) {
            return e.ads.adScheduleId
        },
        at: function(e) {
            return F()
        },
        c: function(e) {
            return e.ads.adClient
        },
        ccp: function(e) {
            return e.casting
        },
        cp: function(e) {
            return !e.external.playerAPI.getControls()
        },
        d: function(e) {
            return e.configData.autostartConfig
        },
        eb: function(e) {
            return (a = e.external.playerAPI).getAdBlock ? a.getAdBlock() : -1;
            var a
        },
        ed: function(e) {
            return e.accountData.edition
        },
        emi: function(e) {
            return e.staticPlayerData.embedID
        },
        i: function(e) {
            return e.browser.pageData.inIframe
        },
        id: function(e) {
            return e.playlistItemData.mediaId
        },
        lid: function(e) {
            return e.browser.storage.localID
        },
        lsa: function(e) {
            return e.browser.storage.storageAvailable
        },
        mt: function(e) {
            return e.external.playerAPI.getMute()
        },
        mu: function(e) {
            return function(e, a) {
                var t = void 0;
                if (!e) return null;
                var n = e.sources;
                if (n) {
                    for (var r = [], i = n.length; i--;) n[i].file && r.push(n[i].file);
                    r.sort(), t = r[0]
                } else t = e.file;
                return a.getAbsolutePath(t)
            }(e.playlistItemData.item, e.external.utils)
        },
        pbd: function(e) {
            return e.playerData.defaultPlaybackRate
        }
    };
    Be.pbr = function(e) {
        return (a = e.external.playerAPI).getPlaybackRate ? Math.round(100 * a.getPlaybackRate()) / 100 : 1;
        var a
    }, Be.pgi = function(e) {
        return e.browser.pageData.pageViewId
    }, Be[L] = function(e) {
        return e.configData.playerHosting
    }, Be.pid = function(e) {
        return e.configData.playerConfigKey
    }, Be.pii = function(e) {
        return e.playlistItemData.index
    }, Be.pl = function(e) {
        return e.playerData.playerSize.height
    }, Be.plc = function(e) {
        return e.external.playerAPI.getPlaylist().length
    }, Be.pli = function(e) {
        return e.playlistItemData.itemId
    }, Be.pp = function(e) {
        return W(e.external.playerAPI)
    }, Be.prc = function(e) {
        return function() {
            var e = window.jwplayer,
                a = 0;
            if ("function" == typeof e)
                for (a = 0; a < 1e3; a++)
                    if (!e(a).uniqueId) return a;
            return a
        }()
    }, Be.ps = function(e) {
        return e.playerData.playerSize.bucket
    }, Be.pss = function(e) {
        return e.meta.playbackTracking.playSessionSequence
    }, Be.pt = function(e) {
        return e.browser.pageData.pageTitle
    }, Be.pu = function(e) {
        return e.browser.pageData.pageURL
    }, Be.pv = function(e) {
        return e.staticPlayerData.playerVersion
    }, Be.pyc = function(e) {
        return e.meta.playbackTracking.playItemCount
    }, Be.s = function(e) {
        return e.configData.sharingEnabled
    }, Be.sdk = function(e) {
        return e.staticPlayerData.sdkPlatform
    }, Be.stc = function(e) {
        return e.meta.setupCount
    }, Be.sv = function(e) {
        return e.staticPlayerData.sdkVersion
    }, Be.t = function(e) {
        return Te(e.playlistItemData.item)
    }, Be.tul = function(e) {
        return e.playlistItemData.item.thumbnailUrl
    }, Be.tv = function(e) {
        return "3.11.0"
    }, Be.vb = function(e) {
        return e.playerData.viewable
    }, Be.vi = function(e) {
        var a = e.playerData.playerConfig.visibility;
        return void 0 === a ? a : Math.round(100 * a) / 100
    }, Be.vl = function(e) {
        return e.external.playerAPI.getVolume()
    }, Be.wd = function(e) {
        return e.playerData.playerSize.width
    }, Be.xid = function(e) {
        return e.playlistItemData.externalId
    }, Be.xav = function(e) {
        return e.meta.xidAlgorithmVersion
    }, Be.stpe = function(e) {
        return !!e.meta.playbackTracking.sendSetTimeEvents
    }, Be.ppm = function(e) {
        return e.playerData.playbackMode
    }, Be.gerr = function(e) {
        return e.temporaryGCID.gcidError
    }, Be.gifr = function(e) {
        return e.temporaryGCID.gcidIframeShouldBeRequested
    }, Be.gfb = function(e) {
        return e.temporaryGCID.gcidIsOnFacebook
    }, Be.gios = function(e) {
        return e.temporaryGCID.gcidIsOnIOS
    };
    var Me = {
            cb: function(e) {
                return e.configData.castingBlockPresent
            },
            dd: function(e) {
                return e.configData.displayDescription
            },
            ga: function(e) {
                return e.configData.gaBlockPresent
            },
            pad: function(e) {
                return e.configData.abTestConfig
            },
            pbc: function(e) {
                return e.configData.playbackRateControlsSet
            },
            po: function(e) {
                return e.configData.posterImagePresent
            },
            r: function(e) {
                return e.configData.relatedPluginConfigPresent
            },
            rf: function(e) {
                return e.configData.relatedPluginFeedFile
            },
            sn: function(e) {
                return e.configData.skinName
            },
            vp: function(e) {
                return e.configData.visualPlaylist
            }
        },
        je = {
            dnt: function(e) {
                return e.browser.storage.doNotTrackProperty
            },
            fv: function(e) {
                return e.browser.pageData.flashVersion
            },
            lng: function(e) {
                return e.browser.langAttr
            },
            pdr: function(e) {
                return e.browser.docReferrer
            }
        };
    je.plt = function(e) {
        return function() {
            var e = (window.performance || {}).timing;
            if (e) {
                var a = (e.loadEventEnd || (new Date).getTime()) - e.navigationStart;
                if (0 < a) return 50 * Math.round(a / 50) | 0
            }
            return null
        }()
    }, je.sp = function(e) {
        return e.browser.isPageStandalone
    };
    var Oe = {
        aes: 1,
        widevine: 2,
        playready: 3,
        fairplay: 4
    };
    var Le = {
        interaction: 1,
        autostart: 2,
        repeat: 3,
        external: 4,
        "related-interaction": 1,
        "related-auto": 5,
        playlist: 6,
        viewable: 7
    };
    var Ge = {
        none: 1,
        metadata: 2,
        auto: 3
    };
    var _e = [I, h, w, k],
        Ve = n,
        Ne = a,
        qe = {};

    function Fe(e) {
        try {
            return e.external.playerAPI.qoe().item.sums.stalled || 0
        } catch (e) {
            return 0
        }
    }
    qe.mk = function(e) {
        return function(e, a) {
            if (!e) return null;
            var t = e.sources[0],
                n = t.type;
            if (!n) {
                var r = t.file;
                n = a.extension(r)
            }
            return n
        }(e.playlistItemData.item, e.external.utils)
    }, qe.pd = function(e) {
        return a = e.playlistItemData.item, t = a.preload, Ge[t] || 0;
        var a, t
    }, qe.vrt = function(e) {
        return function(e) {
            if (!e || !e.stereomode) return null;
            switch (e.stereomode) {
                case "monoscopic":
                    return 0;
                case "stereoscopicTopBottom":
                    return 1;
                case "stereoscopicLeftRight":
                    return 2;
                default:
                    return null
            }
        }(e.playlistItemData.item)
    }, qe.pr = function(e) {
        return a = e.playlistItemData.playReason, Le[a] || 0;
        var a
    }, qe.psd = function(e) {
        return -1 !== _e.indexOf(e.meta.lastEvent) ? e.related.pinSetId : Ie(e.playlistItemData.item)
    }, qe.vh = function(e) {
        return e.playerData.visualQuality.height
    }, qe.vw = function(e) {
        return e.playerData.visualQuality.width
    }, qe.sbr = function(e) {
        return e.playerData.visualQuality.bitrate
    }, qe.tb = function(e) {
        return function(e) {
            var a = e.getContainer().querySelector("video"),
                t = 0;
            if (a && (t = a.duration, a.buffered && a.buffered.length)) {
                var n = a.buffered.end(a.buffered.length - 1) || 0;
                return Math.round(10 * n) / 10
            }
            return t || (t = Math.abs(e.getDuration())), Math.round(t * e.getBuffer() / 10) / 10
        }(e.external.playerAPI)
    }, qe.vd = function(e) {
        return e.playlistItemData.duration
    }, qe.q = function(e) {
        return Ce(e.playlistItemData.duration)
    }, qe.tt = function(e) {
        return a = e.playlistItemData.item, t = a.tracks, Array.prototype.some.call(t || 0, function(e) {
            return "thumbnails" === e.kind
        });
        var a, t
    }, qe.vs = function(e) {
        var a = e.meta.playbackEvents;
        return function(e, a, t) {
            var n = 3 < arguments.length && void 0 !== arguments[3] ? arguments[3] : {};
            if (!a) return null;
            if (t && t.levels && t.levels.length) {
                var r = t.levels[0];
                if (r && "auto" === ("" + r.label).toLowerCase()) return 5
            }
            if (Q(e.getContainer(), "jw-flag-audio-player")) return 6;
            var i = 0 | n.width,
                o = 0 | n.height;
            return 0 === i && 0 === o ? "rtmp" === a.sources[0].type ? 6 : 0 : i <= 320 ? 1 : i <= 640 ? 2 : i <= 1280 ? 3 : 4
        }(e.external.playerAPI, e.playlistItemData.item, a[Ve], a[Ne])
    }, qe.ptid = function(e) {
        return d(e.playlistItemData.item, "variations.selected.images.id")
    };
    var Qe = Math.round,
        Ue = {
            st: function(e) {
                return e.playerData.setupTime
            }
        };
    Ue.bwe = function(e) {
        return i(e.playerData.playerConfig.bandwidthEstimate)
    }, Ue.cct = function(e) {
        return a = e.playlistItemData.item, t = e.external.playerAPI, Array.prototype.some.call(a.tracks || 0, function(e) {
            var a = e.kind;
            return "captions" === a || "subtitles" === a
        }) ? 1 : 1 < t.getCaptionsList().length ? 2 : 0;
        var a, t
    }, Ue.drm = function(e) {
        return ((a = e.playlistItemData.drm) ? Oe[a] || 999 : 0) || e.meta.playbackTracking.segmentsEncrypted;
        var a
    }, Ue.ff = function(e) {
        return "function" == typeof(a = e.external.playerAPI).qoe ? 10 * Math.round(a.qoe().firstFrame / 10) | 0 : -1;
        var a
    }, Ue.l = function(e) {
        return a = e.playlistItemData.duration, (a |= 0) <= 0 || a === 1 / 0 ? 0 : a < 15 ? 1 : a <= 300 ? 2 : a <= 1200 ? 3 : 4;
        var a
    }, Ue.vr = function(e) {
        return function(e) {
            if (e.getPlugin) {
                var a = e.getPlugin("vr");
                if (a) switch (a.getMode()) {
                    case "magic-window":
                        return 0;
                    case "cardboard":
                        return 1;
                    case "gear-vr":
                        return 2;
                    default:
                        return null
                }
            }
            return null
        }(e.external.playerAPI)
    }, Ue.etw = function(e) {
        return e.meta.playbackTracking.retTimeWatched
    }, Ue.ubc = function(e) {
        return Qe(Fe(e))
    }, Ue.ubi = function(e) {
        return Qe(function(e, a) {
            void 0 === a && (a = e.meta.lastEvent);
            var t = Fe(e),
                n = e.meta.previousBufferTimes[a];
            void 0 === e.meta.previousBufferTimes[a] && (n = e.meta.previousBufferTimes[a] = t);
            var r = Math.round(t - n);
            return e.meta.previousBufferTimes[a] = t, r
        }(e))
    }, Ue.pw = function(e) {
        return 0 | e.meta.playbackTracking.normalizedTime
    }, Ue.ti = function(e) {
        return e.meta.playbackTracking.elapsedSeconds
    }, Ue.vti = function(e) {
        return e.meta.playbackTracking.viewableElapsedSeconds
    }, Ue.ati = function(e) {
        return e.meta.playbackTracking.audibleElapsedSeconds
    }, Ue.cvl = function(e) {
        return Math.floor(e.meta.seekTracking.videoStartDragTime)
    }, Ue.tvl = function(e) {
        return Math.floor(e.meta.seekTracking.lastTargetTime)
    }, Ue.sdt = function(e) {
        return 1 === e.meta.seekTracking.numTrackedSeeks ? 0 : Date.now() - e.meta.seekTracking.dragStartTime
    }, Ue.vso = function(e) {
        return Math.floor(e.meta.seekTracking.lastTargetTime) - Math.floor(e.meta.seekTracking.videoStartDragTime)
    }, Ue.qcr = function(e) {
        return e.playerData.visualQuality.reason
    }, Ue.abm = function(e) {
        return e.playerData.visualQuality.adaptiveBitrateMode
    }, Ue.avc = function(e) {
        return e.playerData.numAutoVisualQualityChange
    }, Ue.ppr = function(e) {
        return e.meta.playbackTracking.prevPlaybackRate
    }, Ue.erc = function(e) {
        return e.playerData.lastErrorCode[e.meta.lastEvent]
    }, Ue.pcp = function(e) {
        return Qe(e.meta.playbackTracking.currentPosition)
    }, Ue.stg = function(e) {
        return e.sharing.shareMethod
    }, Ue.tps = function(e) {
        return Qe(e.meta.playbackTracking.playedSecondsTotal)
    }, Ue.srf = function(e) {
        return e.sharing.shareReferrer
    }, Ue.plng = function(e) {
        return e.playerData.localization.language
    }, Ue.pni = function(e) {
        return e.playerData.localization.numIntlKeys
    }, Ue.pnl = function(e) {
        return e.playerData.localization.numLocalKeys
    }, Ue.pbs = function(e) {
        try {
            return e.external.playerAPI.qoe().item.counts.stalled || 0
        } catch (e) {
            return null
        }
    }, Ue.tc = function(e) {
        return e.meta.playbackTracking.thresholdCrossed
    }, Ue.flc = function(e) {
        return e.playerData.floatingConfigured
    }, Ue.fls = function(e) {
        return e.playerData.playerConfig.floatingState
    };
    var Ke = {
            fed: function(e) {
                return -1 !== _e.indexOf(e.meta.lastEvent) ? e.related.feedId : ke(e.playlistItemData.item)
            },
            fid: function(e) {
                return -1 !== _e.indexOf(e.meta.lastEvent) ? e.related.feedInstanceId : we(e.playlistItemData.item)
            },
            ft: function(e) {
                return e.related.feedType
            },
            os: function(e) {
                return e.related.onClickSetting
            },
            fin: function(e) {
                return e.related.feedInterface
            },
            fis: function(e) {
                return e.related.idsShown.join(",")
            },
            fns: function(e) {
                return e.related.idsShown.length
            },
            fpc: function(e) {
                return e.related.pinnedCount
            },
            fpg: function(e) {
                return e.related.page
            },
            fsr: function(e) {
                return e.related.shownReason
            },
            rat: function(e) {
                return e.related.autotimerLength
            },
            fct: function(e) {
                return e.related.advanceTarget
            },
            oc: function(e) {
                return e.related.ordinalClicked
            },
            stid: function(e) {
                return e.related.targetThumbID
            },
            tis: function(e) {
                return e.related.thumbnailIdsShown.join(",") || void 0
            },
            fsid: function(e) {
                return e.related.feedShownId
            },
            vfi: function(e) {
                return e.related.feedWasViewable
            },
            cme: function(e) {
                return e.playerData.contextualEmbed
            },
            pogt: function(e) {
                return e.browser.pageData.pageOGTitle
            }
        },
        ze = {};

    function We(e) {
        if (!e.bidders) return {};
        var r = {},
            i = void 0;
        return e.bidders.forEach(function(e) {
            var t, n, a = e.name;
            r[a.toLowerCase()] = (t = e, n = {}, oe.forEach(function(e) {
                var a;
                "result" === e ? n.result = J[t[e]] : ge(n, null != t[e] ? ((a = {})[e] = t[e], a) : void 0), t.code && -1 !== ["error", "invalid"].indexOf(t.result) && (n.errorCode = t.code)
            }), n), e.errorCode && !i && (i = e.errorCode)
        }), ge({
            mediationLayer: ie[e.mediationLayerAdServer],
            floorPriceCents: e.floorPriceCents,
            bidders: r
        }, null != i ? {
            errorCode: i
        } : void 0)
    }
    ze.ab = function(e) {
        return e.configData.advertisingBlockType
    }, ze.abo = function(e) {
        return e.ads.adEventData.offset
    }, ze.adi = function(e) {
        return e.ads.adEventData.adId
    }, ze.apid = function(e) {
        return e.ads.adEventData.adPlayId
    }, ze.abid = function(e) {
        return e.ads.adEventData.adBreakId
    }, ze.awi = function(e) {
        return e.ads.adEventData.witem
    }, ze.awc = function(e) {
        return e.ads.adEventData.wcount
    }, ze.p = function(e) {
        return e.ads.adEventData.adposition
    }, ze.sko = function(e) {
        return e.ads.adEventData.skipoffset
    }, ze.vu = function(e) {
        return e.ads.adEventData.tagdomain
    }, ze.tmid = function(e) {
        return e.ads.adEventData.targetMediaId
    };
    var He = {
        ad: function(e) {
            return e.ads.adEventData.adSystem
        },
        adc: function(e) {
            var a = e.ads.adEventData,
                t = null;
            return Array.isArray(a.categories) && (t = a.categories.map(function(e) {
                var a = e.match(ee);
                return a ? [$.IAB, a[1]].join("-") : $.UNKNOWN
            }).filter(function(e, a, t) {
                return t.indexOf(e) === a
            }).slice(0, 10).join(",") || null), t
        },
        al: function(e) {
            return e.ads.adEventData.linear
        },
        ca: function(e) {
            return e.ads.adEventData.conditionalAd
        },
        cao: function(e) {
            return e.ads.adEventData.conditionalAdOptOut
        },
        ct: function(e) {
            return e.ads.adEventData.adCreativeType
        },
        mfc: function(e) {
            return e.ads.adEventData.mediaFileCompliance
        },
        pc: function(e) {
            return e.ads.adEventData.podCount
        },
        pi: function(e) {
            return e.ads.adEventData.podIndex
        },
        tal: function(e) {
            return e.ads.adEventData.timeAdLoading
        },
        vv: function(e) {
            return e.ads.adEventData.vastVersion
        },
        uav: function(e) {
            return e.ads.adEventData.universalAdId
        },
        atps: function(e) {
            return e.ads.watchedPastSkipPoint
        },
        du: function(e) {
            return e.ads.adEventData.duration
        },
        qt: function(e) {
            var a = e.meta.lastEvent;
            return "s" === a || "c" === a ? e.ads.adEventData.previousQuartile : e.ads.currentQuartile
        },
        tw: function(e) {
            return e.ads.adEventData.position
        },
        aec: function(e) {
            return e.ads.jwAdErrorCode
        },
        ec: function(e) {
            return e.playerData.lastErrorCode[e.meta.lastEvent]
        }
    };
    He.atu = function(e) {
        if (0 === (a = e).ads.adClient && Math.random() <= a.ads.VAST_URL_SAMPLE_RATE) return e.ads.adEventData.tagURL;
        var a
    }, He.cid = function(e) {
        return e.ads.creativeId
    }, He.adt = function(e) {
        return e.ads.adTitle
    }, He.apr = function(e) {
        return e.ads.adEventData.preload
    }, He.amu = function(e) {
        return e.ads.adEventData.adMediaFileURL
    }, He.afbb = function(e) {
        return d(e.ads.headerBiddingData.bidders, "fan.result")
    }, He.afbi = function(e) {
        return d(e.ads.headerBiddingData.bidders, "fan.id")
    }, He.afbp = function(e) {
        return d(e.ads.headerBiddingData.bidders, "fan.priceInCents")
    }, He.afbt = function(e) {
        return d(e.ads.headerBiddingData.bidders, "fan.timeForBidResponse")
    }, He.afbw = function(e) {
        return d(e.ads.headerBiddingData.bidders, "fan.winner")
    }, He.frid = function(e) {
        return d(e.ads.headerBiddingData.bidders, "fan.requestId")
    }, He.asxb = function(e) {
        return d(e.ads.headerBiddingData.bidders, "spotx.result")
    }, He.asxi = function(e) {
        return d(e.ads.headerBiddingData.bidders, "spotx.id")
    }, He.asxp = function(e) {
        return d(e.ads.headerBiddingData.bidders, "spotx.priceInCents")
    }, He.asxt = function(e) {
        return d(e.ads.headerBiddingData.bidders, "spotx.timeForBidResponse")
    }, He.asxw = function(e) {
        return d(e.ads.headerBiddingData.bidders, "spotx.winner")
    }, He.aml = function(e) {
        return e.ads.headerBiddingData.mediationLayer
    }, He.flpc = function(e) {
        return e.ads.headerBiddingData.floorPriceCents
    }, He.hbec = function(e) {
        return e.ads.headerBiddingData.errorCode
    }, He.vpb = function(e) {
        return JSON.stringify(function e(a) {
            var t = {};
            for (var n in a)
                if ("object" == typeof a[n]) {
                    var r = e(a[n]);
                    for (var i in r) t[n + "." + i] = r[i]
                } else t[n] = a[n];
            return t
        }(e.ads.headerBiddingData.bidders))
    }, He.vcb = function(e) {
        return e.ads.headerBiddingCacheData.bidder
    }, He.vck = function(e) {
        return e.ads.headerBiddingCacheData.cacheKey
    };
    var Xe = {
            prs: function(e) {
                return e.meta.playerState
            },
            lae: function(e) {
                return e.meta.eventPreAbandonment
            },
            abpr: function(e) {
                return e.meta.playerRemoved
            },
            prsd: function(e) {
                var a = Date.now() - e.meta.playerStateDuration;
                return a <= 216e5 ? a : -1
            }
        },
        Ye = ge({}, Be, Me, je, qe, Ue, Ke, ze, He, Xe);

    function $e(e, r) {
        var a = xe.events[e],
            t = a.parameterGroups.reduce(function(e, a) {
                return e.concat(xe.paramGroups[a].members)
            }, []).concat(a.pingSpecificParameters ? a.pingSpecificParameters : []).map(function(e) {
                return t = r, n = Ye[a = e] ? Ye[a] : function() {
                    t.meta.debug && console.log("No parameter generation function for param " + a)
                }, {
                    code: a,
                    value: n(t)
                };
                var a, t, n
            });
        return {
            event: a.code,
            bucket: a.bucket,
            parameters: t
        }
    }
    var Je = 1,
        Ze = 2,
        ea = 3,
        aa = 4,
        ta = 5,
        na = 0;
    var ra = [h, D];

    function ia(e, a, t) {
        var n = e.external.playerAPI,
            r = n.getConfig();
        e.playerData.playerConfig = {
            visibility: r.visibility,
            bandwidthEstimate: r.bandwidthEstimate,
            floatingState: !!r.isFloating
        };
        var i, o, d, l = z(n) || {};
        e.playlistItemData.item = l, e.playlistItemData.mediaId = Se(l), e.playerData.playerSize = function(e) {
            var a = e.getConfig(),
                t = a.containerWidth || e.getWidth(),
                n = a.containerHeight || e.getHeight();
            if (/\d+%/.test(t)) {
                var r = e.utils.bounds(e.getContainer());
                t = r.width, n = r.height
            }
            return t = 0 | Math.round(t), n = 0 | Math.round(n), /\d+%/.test(a.width || t) && a.aspectratio ? {
                bucket: aa,
                width: t,
                height: n
            } : Q(e.getContainer(), "jw-flag-audio-player") ? {
                bucket: ta,
                width: t,
                height: n
            } : 0 === t ? {
                bucket: na,
                width: t,
                height: n
            } : t <= 320 ? {
                bucket: Je,
                width: t,
                height: n
            } : t <= 640 ? {
                bucket: Ze,
                width: t,
                height: n
            } : {
                bucket: ea,
                width: t,
                height: n
            }
        }(n), e.playlistItemData.duration = Y(e), e.meta.lastEvent = a, e.meta.lastBucket = t, e.playerData.visualQuality = X(n, "s" === a && "jwplayer6" === t), e.playerData.defaultPlaybackRate = r.defaultPlaybackRate, e.playerData.playbackMode = r.streamType, Ae(e, l), i = e, o = a, d = t, -1 === ra.indexOf(o) && (i.meta.eventPreAbandonment = u(o, d))
    }
    var oa = function(e, a, t) {
            for (var n = [{
                    code: T,
                    value: e
                }, {
                    code: S,
                    value: Math.random().toFixed(16).substr(2, 16)
                }].concat(t), r = [], i = 0; i < n.length; i++) {
                var o = n[i].value;
                !0 !== o && !1 !== o || (o = o ? 1 : 0), null != o && r.push(n[i].code + "=" + encodeURIComponent(o))
            }
            var d = "file:" === window.location.protocol ? "https:" : "",
                l = r.join("&");
            return d + "playergk/ping.gif?" + ("h=" + function(e) {
                var a = 0;
                if (!(e = decodeURIComponent(e)).length) return a;
                for (var t = 0; t < e.length; t++) a = (a << 5) - a + e.charCodeAt(t), a &= a;
                return a
            }(l) + "&" + l)
        },
        da = function(e) {
            e.trackingState.pageLoaded = !0;
            for (var a = e.trackingState.queue.length; a--;) ca(e, e.trackingState.queue.shift());
            window.removeEventListener("load", e.trackingState.boundFlushQueue)
        };

    function la(e) {
        var a = e.external.playerAPI,
            t = "complete" === (a.getContainer().ownerDocument || window.document).readyState;
        (e.trackingState.pageLoaded = t) || (e.trackingState.boundFlushQueue = da.bind(null, e), window.addEventListener && window.addEventListener("load", e.trackingState.boundFlushQueue), setTimeout(e.trackingState.boundFlushQueue, 5e3))
    }

    function ua(e, a) {
        var t = a.event,
            n = a.bucket,
            r = a.parameters,
            i = oa(t, n, r),
            o = !e.trackingState.pageLoaded;
        if (o && (t === E || t === C || t === A)) da(e);
        else if (o) return void e.trackingState.queue.push(i);
        ca(e, i)
    }

    function ca(e, a) {
        var t = new Image,
            n = void 0;
        try {
            n = Date.now()
        } catch (e) {}
        t.src = a + "&" + P + "=" + n;
        for (var r = e.trackingState.images, i = r.length; i-- && (r[i].width || r[i].complete);) r.length = i;
        if (r.push(t), e.meta.debug && e.trackingState.onping) try {
            e.trackingState.onping.call(null, a)
        } catch (e) {}
    }
    var sa = {
        delaySend: !1,
        returnURL: !1
    };

    function pa(t, e) {
        var a = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : "jwplayer6",
            n = 3 < arguments.length && void 0 !== arguments[3] ? arguments[3] : {};
        n = ge({}, sa, n), ia(t, e, a);
        var r = u(e, a);
        if (!(xe.events[r].filters || []).map(function(e) {
                return a = t, Re[e](a);
                var a
            }).some(function(e) {
                return !!e
            })) {
            var i = $e(r, t);
            return n.delaySend ? ua.bind(null, t, i) : n.returnURL ? oa(i.event, i.bucket, i.parameters) : void ua(t, i)
        }
    }
    var fa = 1e3;

    function ma(e) {
        return 0 < e.numTrackedSeeks
    }
    var ga = a,
        va = e,
        ya = o;

    function ba(e) {
        e.meta.playbackTracking.playItemCount++, pa(e, "s")
    }

    function ha(d, l) {
        return function(e) {
            var a = d.meta.playbackEvents,
                t = d.playlistItemData,
                n = d.meta.playbackTracking,
                r = d.external.playerAPI,
                i = a[l];
            if (l === ga) {
                var o = e.segment;
                o && (n.segmentReceived = !0, n.segmentsEncrypted = o.encryption), t.drm = e.drm || ""
            }(a[l] = e, l === va && (i || (n.playedSeconds = 0, n.viewablePlayedSeconds = 0, n.audiblePlayedSeconds = 0, n.playedSecondsTotal = 0), n.previousTime = K(r)), l === ya) && ("flash_adaptive" === W(r) ? !d.meta.playbackSent && n.segmentReceived && (d.meta.playbackSent = !0, n.segmentReceived = !1, ba(d)) : d.meta.playbackSent || (d.meta.playbackSent = !0, ba(d)))
        }
    }

    function ka(e) {
        var a = e.meta.playbackTracking,
            t = a.playedSeconds,
            n = a.viewablePlayedSeconds,
            r = a.audiblePlayedSeconds;
        a.playedSeconds = 0, a.viewablePlayedSeconds = 0;
        var i = t + .5 | (a.audiblePlayedSeconds = 0);
        a.elapsedSeconds = i;
        var o = n + .5 | 0;
        a.viewableElapsedSeconds = o;
        var d = r + .5 | 0;
        a.audibleElapsedSeconds = d, 0 < i && pa(e, v)
    }

    function wa(e, a, t, n) {
        a < n && n <= a + t && (e.meta.playbackTracking.retTimeWatched = n, pa(e, "ret"))
    }

    function Ia(e, a, t) {
        var n, r, i, o = f + "-" + t;
        n = a, r = t, i = o, e.meta.pingLimiters.playlistItem.canSendPing(i) && Math.floor(n) == r && (e.meta.playbackTracking.thresholdCrossed = t, pa(e, f), e.meta.pingLimiters.playlistItem.setPingSent(o))
    }

    function Da(e, a) {
        var t, n;
        2 < arguments.length && void 0 !== arguments[2] && arguments[2] ? function(e) {
            var a = e.meta.seekTracking;
            if (ma(a)) {
                clearTimeout(a.seekDebounceTimeout);
                var t = pa(e, "vs", "jwplayer6", {
                    delaySend: !0
                });
                a.seekDebounceTimeout = setTimeout(function() {
                    var e;
                    t && t(), (e = a).videoStartDragTime = 0, e.dragStartTime = 0, e.seekDebounceTimeout = null, e.lastTargetTime = 0, e.numTrackedSeeks = 0
                }, fa)
            }
        }(e) : (t = e.meta.seekTracking, n = a, ma(t) || (t.videoStartDragTime = n.position, t.dragStartTime = Date.now()), t.numTrackedSeeks++, t.lastTargetTime = n.offset)
    }

    function Sa(e, a, t) {
        var n, r;
        e.playerData.lastErrorCode[a] = t.code, e.meta.eventPreAbandonment = u(a, "error"), e.errors.numberEventsSent < e.errors.NUM_ERRORS_PER_SESSION && (r = a, "number" == typeof(n = e).playerData.lastErrorCode[r] || Math.random() < n.errors.SAMPLE_RATE) && (e.errors.numberEventsSent += 1, pa(e, a, p))
    }

    function Ta(e, a) {
        e.meta.playerState !== a && (e.meta.playerStateDuration = Date.now()), e.meta.playerState = a
    }
    var Pa = o,
        Ea = n,
        Aa = a,
        Ca = e;

    function xa(e) {
        e.meta.playbackEvents = {}, e.meta.playbackSent = !1, e.meta.playbackTracking.trackingSegment = 0, e.playerData.numAutoVisualQualityChange = 0, e.meta.pingLimiters.playlistItem.resetAll()
    }

    function Ra(p) {
        var e, a, f = p.external.playerAPI,
            i = function(e, a) {
                e.playlistItemData.playReason = a.playReason || "", pa(e, "pa")
            }.bind(null, p),
            t = function(e, a) {
                var t = e.playlistItemData.mediaId;
                t && t === Se(a.item) && (e.playerData.lastErrorCode[b] = a.code, pa(e, "paf", "error"))
            }.bind(null, p);
        f.on("idle buffer play pause complete error", function(e) {
            Ta(p, e.type)
        }), f.on("idle", xa.bind(null, p)), f.on("ready", function(e) {
            p.playlistItemData.ready = ge({}, e), p.playerData.viewable = f.getViewable(), p.playerData.muted = f.getMute(), p.playerData.volume = f.getVolume()
        }), f.on("playlistItem", function(e) {
            var a = p.playlistItemData;
            a.drm = "", a.itemId = R(12), p.meta.playbackTracking.playSessionSequence++, a.index = e.index;
            var t, n, r = e.item || z(f);
            r && (a.mediaId = Se(r), Ae(p, r)), a.ready && (t = p, n = a.ready, t.playerData.setupTime = -1, n && n.setupTime && (t.playerData.setupTime = 10 * Math.round(n.setupTime / 10) | 0), pa(t, "e"), a.item = null, a.ready = null), f.off("beforePlay", i), f.once("beforePlay", i), xa(p), p.meta.playbackTracking.segmentReceived = p.meta.playbackTracking.segmentsEncrypted = !1, me(p)
        }), f.on("playAttemptFailed", t), f.on("meta", ha(p, Aa)), f.on("levels", ha(p, Ea)), f.on("play", ha(p, Ca)), f.on("firstFrame", ha(p, Pa)), f.on("time", function(e) {
            var a = p.meta.playbackEvents,
                t = p.meta.playbackTracking,
                n = K(f);
            t.currentPosition = n;
            var r = e.duration;
            if (n) {
                1 < n && (a[Ea] || ha(p, Ea)({}));
                var i, o, d, l = Ce(r),
                    u = (i = n, d = l, (o = r) === 1 / 0 ? null : i / (o / d) + 1 | 0);
                0 === t.trackingSegment && (t.trackingSegment = u), null === t.previousTime && (t.previousTime = n);
                var c = n - t.previousTime;
                if (t.previousTime = n, c = Math.min(Math.max(0, c), 4), t.playedSeconds = t.playedSeconds + c, p.playerData.viewable && (t.viewablePlayedSeconds = t.viewablePlayedSeconds + c), !p.playerData.muted && 0 < p.playerData.volume && (t.audiblePlayedSeconds = t.audiblePlayedSeconds + c), wa(p, t.playedSecondsTotal, c, 10), wa(p, t.playedSecondsTotal, c, 30), wa(p, t.playedSecondsTotal, c, 60), t.playedSecondsTotal = t.playedSecondsTotal + c, !0 === t.sendSetTimeEvents && (Ia(p, n, 3), Ia(p, n, 10), Ia(p, n, 30)), r <= 0 || r === 1 / 0) 10 <= t.playedSeconds && ka(p);
                else if (u === t.trackingSegment + 1) {
                    var s = m * t.trackingSegment / l;
                    if (l < u) return;
                    t.normalizedTime = s, ka(p), t.trackingSegment = 0
                }
            }
        }), f.on("seek", function(e) {
            p.meta.playbackTracking.previousTime = K(f), p.meta.playbackTracking.trackingSegment = 0, Da(p, e)
        }), f.on("seeked", function(e) {
            Da(p, e, !0)
        }), f.on("complete", function() {
            var e = p.meta.playbackTracking,
                a = Y(p);
            if (!(a <= 0 || a === 1 / 0)) {
                Ce(a);
                e.normalizedTime = m, ka(p), e.playedSecondsTotal = 0
            }
        }), f.on("cast", function(e) {
            p.casting = !!e.active
        }), f.on("playbackRateChanged", function(e) {
            pa(p, "pru"), p.meta.playbackTracking.prevPlaybackRate = e.playbackRate
        }), f.on("visualQuality", function(e) {
            "auto" === e.reason && (p.playerData.numAutoVisualQualityChange += 1);
            var a, t, n = X(f);
            a = n, t = !1, H.width === a.width && H.height === a.height || (t = !0), H = a, t && -1 === l.indexOf(n.reason) && pa(p, "vqc")
        }), f.on(c.join(" "), function() {
            p.ads.adBreakTracking && (p.ads.adBreakTracking.shouldTrack = !0)
        }), f.on("error", Sa.bind(null, p, G)), f.on("setupError", Sa.bind(null, p, x)), f.on("autostartNotAllowed", function() {
            pa(p, g)
        }), f.on("viewable", function(e) {
            p.playerData.viewable = e.viewable
        }), f.on("mute", function(e) {
            p.playerData.muted = e.mute
        }), f.on("volume", function(e) {
            p.playerData.volume = e.volume
        }), xa(p), a = v, (e = p).meta.previousBufferTimes[a] = Fe(e)
    }

    function Ba(t, e) {
        var n = t.ads.adEventData;
        if (-1 === t.ads.adClient && e && (t.ads.adClient = B(e.client)), e.sequence !== n.podIndex && (delete n.timeAdLoading, delete n.adCreativeType), Ma(n, e, "offset"), Ma(n, e, "witem"), Ma(n, e, "wcount"), Ma(n, e, "skipoffset"), Ma(n, e, "linear", function(e, a) {
                return a === e
            }), Ma(n, e, "adposition", function(e, a) {
                return {
                    pre: 0,
                    mid: 1,
                    post: 2,
                    api: 3
                }[a]
            }), Ma(n, e, "creativetype", function(e, a) {
                var t = "";
                switch (a) {
                    case "static":
                        t = "image/unknown";
                        break;
                    case "video":
                        t = "video/unknown";
                        break;
                    case "vpaid":
                    case "vpaid-swf":
                        t = "application/x-shockwave-flash";
                        break;
                    case "vpaid-js":
                        t = "application/javascript";
                        break;
                    default:
                        t = a || t
                }
                return n.adCreativeType = t
            }), Ma(n, e, "tag", function(e, a) {
                return n.tagdomain = function(e) {
                    if (e) {
                        var a = e.match(new RegExp(/^[^/]*:\/\/\/?([^\/]*)/));
                        if (a && 1 < a.length) return a[1]
                    }
                    return ""
                }(t.external.playerAPI.utils.getAbsolutePath(a)), a
            }), e.timeLoading && (n.timeAdLoading = 10 * Math.round(e.timeLoading / 10)), e.universalAdIdRegistry && "unknown" !== e.universalAdIdRegistry ? n.universalAdId = e.universalAdIdRegistry + "." + e.universalAdIdValue : delete n.universalAdId, n.conditionalAd = e.conditionalAd, n.conditionalAdOptOut = !!e.conditionalAdOptOut, n.mediaFileCompliance = e.mediaFileCompliance, n.categories = e.categories, n.adSystem = e.adsystem || n.adSystem, n.vastVersion = e.vastversion || n.vastVersion, n.podIndex = e.sequence || n.podIndex, n.podCount = e.podcount || n.podCount, n.tagURL = e.tag || n.tagURL || e.vmap, n.preload = "boolean" == typeof e.preloadAds ? e.preloadAds : n.preload, n.adPlayId = e.adPlayId || n.adPlayId, n.adBreakId = e.adBreakId || n.adBreakId, e.item) {
            var a = Se(e.item);
            n.targetMediaId = a != t.playlistItemData.mediaId ? a : null
        }
        t.ads.headerBiddingData = We(e)
    }

    function Ma(e, a, t) {
        var n = 3 < arguments.length && void 0 !== arguments[3] ? arguments[3] : ja;
        if (a.hasOwnProperty(t)) {
            var r = n;
            e[t] = r(t, a[t])
        }
    }

    function ja(e, a) {
        return a
    }

    function Oa(e, a) {
        var t = e.ads.adEventData,
            n = e.ads.currentQuartile;
        n > t.previousQuartile && (Ba(e, a), pa(e, "v", "clienta"), t.previousQuartile = n)
    }
    var La = {
        adComplete: function(e, a) {
            e.ads.currentQuartile = 4, Oa(e, a)
        },
        adError: function(e, a) {
            "object" == typeof a && a && (e.playerData.lastErrorCode.ae = a.code || 1, e.ads.jwAdErrorCode = a.adErrorCode), pa(e, "ae", "clienta")
        },
        adTime: function(e, a) {
            var t = e.ads.adEventData;
            t.position = a.position, t.duration = t.duration || a.duration, t.position > t.duration || (e.ads.currentQuartile = Math.min(3, Math.floor((4 * t.position + .05) / t.duration)), Oa(e, a))
        },
        adSkipped: function(e, a) {
            e.ads.watchedPastSkipPoint = a.watchedPastSkipPoint, pa(e, "s", "clienta")
        },
        adImpression: function(e, a) {
            e.ads.adTitle = a.adtitle;
            var t = void 0;
            "googima" === a.client ? (e.ads.creativeId = d(a, "ima.ad.g.creativeId"), t = d(a, "ima.ad.g.mediaUrl")) : (e.ads.creativeId = d(a, "creativeId"), t = d(a, "mediafile.file")), e.ads.adEventData.adMediaFileURL = "string" == typeof t ? t.substring(0, 2500) : t, pa(e, E, "clienta")
        },
        adBreakEnd: function(e, a) {
            e.ads.adEventData = ge({}, Z)
        }
    };

    function Ga(i) {
        var e = i.external.playerAPI;
        e.on(re.join(" "), function() {
            Ta(i, "ad-break"), i.ads.adBreakTracking && i.ads.adBreakTracking.shouldTrack && (i.ads.adBreakTracking.shouldTrack = !1, i.ads.adBreakTracking.adBreakCount++)
        }), e.on("adClick adRequest adMeta adImpression adComplete adSkipped adError adTime adBidRequest adBidResponse adStarted adLoaded adViewableImpression adBreakEnd", function(e) {
            var a, t, n, r = i.ads.adEventData;
            a = r, "adClick" === (t = e).type || a && a.adId === t.id && -1 !== t.id || (i.ads.adEventData = ge({
                adId: e.id
            }, Z)), n = e, -1 === ne.indexOf(n.type) && Ba(i, e), e.type in La ? La[e.type](i, e) : -1 === te.indexOf(e.type) && pa(i, ae[e.type], "clienta")
        })
    }

    function _a(e, a) {
        e.related.feedId = ke(a), e.related.feedInstanceId = we(a), e.related.feedType = De(a, "kind"), e.related.feedShownId = a.feedShownId, e.related.onClickSetting = "onclick" in a ? "play" === a.onclick ? 1 : 0 : void 0, e.related.feedInterface = a.ui;
        var t = a.itemsShown || [],
            n = 0,
            r = [],
            i = [],
            o = !0;
        t.forEach(function(e) {
            Ie(e) && n++, r.push(Se(e));
            var a = d(e, "variations.selected.images.id");
            a && (o = !1), i.push(a || "null")
        }), e.related.thumbnailIdsShown = o ? [] : i, e.related.idsShown = r, e.related.pinnedCount = n, e.related.page = a.page, e.related.autotimerLength = a.autoTimer, e.related.pinSetId = Ie(a.target), e.related.advanceTarget = Se(a.target), e.related.targetThumbID = d(a.target, "variations.selected.images.id"), e.related.ordinalClicked = "position" in a ? a.position + 1 : a.index
    }

    function Va(e, a, t) {
        _a(e, a), pa(e, t)
    }

    function Na(e) {
        e.external.playerAPI.on("ready", function() {
            ! function(a) {
                var e = a.external.playerAPI;
                if (e.getPlugin) {
                    var t = e.getPlugin("related");
                    t && (t.on("playlist", function(e) {
                        null !== e.playlist && Va(a, e, h)
                    }), t.on("feedShown", function(e) {
                        Ta(a, "recs-overlay"), a.related.shownReason = e.reason, a.related.feedWasViewable = e.viewable, Va(a, e, k)
                    }), t.on("feedClick", function(e) {
                        Va(a, e, w)
                    }), t.on("feedAutoAdvance", function(e) {
                        Va(a, e, I)
                    })), e.on("playlistItem", function() {
                        a.related.sendHoverPing = !0, a.related.nextShownReason = null, a.related.shownReason = null
                    }), e.on("nextShown", function(e) {
                        a.related.nextShownReason = e.reason, a.related.shownReason = e.reason, Ta(a, "recs-overlay"), ("hover" !== e.reason || a.related.sendHoverPing) && (a.related.sendHoverPing = !1, Va(a, e, k))
                    }), e.on("nextClick", function(e) {
                        a.related.nextShownReason && Va(a, e, w)
                    }), e.on("nextAutoAdvance", function(e) {
                        Va(a, e, I)
                    })
                }
            }(e)
        })
    }
    var qa = {
        facebook: "fb",
        twitter: "twi",
        email: "em",
        link: "cl",
        embed: "ceb",
        pinterest: "pin",
        tumblr: "tbr",
        googleplus: "gps",
        reddit: "rdt",
        linkedin: "lkn",
        custom: "cus"
    };

    function Fa(e) {
        e.external.playerAPI.on("ready", function() {
            ! function(a) {
                var e = a.external.playerAPI;
                if (e.getPlugin) {
                    var t = e.getPlugin("sharing");
                    t && t.on("click", function(e) {
                        a.sharing.shareMethod = qa[e.method] || qa.custom, pa(a, y)
                    })
                }
            }(e)
        })
    }

    function Qa(e) {
        var a, t;
        "function" == typeof navigator.sendBeacon && (a = e, t = function() {
            var e = pa(a, D, "jwplayer6", {
                returnURL: !0
            });
            void 0 !== e && navigator.sendBeacon(e)
        }, window.addEventListener("unload", t), a.external.playerAPI.on("remove", function() {
            window.removeEventListener("unload", t), a.meta.playerRemoved = !0, pa(a, D, "jwplayer6")
        }))
    }(window.jwplayerPluginJsonp || window.jwplayer().registerPlugin)("jwpsrv", "7.0", function(e, a, t) {
        var n, r, i = be(e, a, t);
        Qa(n = i), Ra(n), Ga(n), Na(n), Fa(n), la(i), this.getTrackingPixelURLs = (r = i, function(e, a) {
            if (e && a) {
                r.ads.headerBiddingCacheData.bidder = e, r.ads.headerBiddingCacheData.cacheKey = a;
                var t = pa(r, "vci", "clienta", {
                        returnURL: !0
                    }),
                    n = pa(r, "vcae", "clienta", {
                        returnURL: !0
                    });
                return r.ads.headerBiddingCacheData.bidder = void 0, r.ads.headerBiddingCacheData.cacheKey = void 0, {
                    impression: t,
                    error: n
                }
            }
        })
    })
}();
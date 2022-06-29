! function() {
    var te = "vast",
        ie = "-1",
        t = "time",
        d = "[ERRORCODE]",
        E = "vmap",
        re = 5e3,
        ne = 15e3,
        ae = "jwp",
        se = "jwpspotx",
        oe = "autostartNotAllowed",
        de = "viewable",
        le = 5,
        l = "paused",
        ue = "playing",
        pe = "adPodError",
        r = "viewable",
        he = "adBidRequest",
        ce = "adBidResponse",
        me = "adBreakEnd",
        n = "adBreakIgnored",
        fe = "adBreakStart",
        a = "adClick",
        ve = "adComplete",
        ge = "adError",
        ye = "adImpression",
        Ae = "adLoaded",
        u = "adMeta",
        o = "adPause",
        p = "adPlay",
        Pe = "adRequest",
        ke = "adSchedule",
        be = "adSkipped",
        e = "adStarted",
        h = "clickthrough",
        we = "external",
        i = we,
        s = "click",
        c = "play",
        m = "error",
        f = "complete",
        v = [ye, ge, pe],
        g = [e, ve, ye, a, be, ge, p, o, u],
        y = function(e, t) {
            if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
        },
        A = function() {
            function r(e, t) {
                for (var i = 0; i < t.length; i++) {
                    var r = t[i];
                    r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(e, r.key, r)
                }
            }
            return function(e, t, i) {
                return t && r(e.prototype, t), i && r(e, i), e
            }
        }(),
        _e = Object.assign || function(e) {
            for (var t = 1; t < arguments.length; t++) {
                var i = arguments[t];
                for (var r in i) Object.prototype.hasOwnProperty.call(i, r) && (e[r] = i[r])
            }
            return e
        },
        P = function() {
            function s(e, t, i, r, n) {
                var a = this;
                y(this, s), this.player = e, this.state = e.state, this.vpaidURL = i, this.adTag = r, this.adParams = n.adParams, this.vpaidControls = n.vpaidControls, this.remainingTimeInterval = null, this.type = "vpaid", this.instream = t || e.createInstream(), this.vpaidState = {
                    linear: !1,
                    expanded: !1,
                    remainingTime: -1
                }, this.paused = !1, _e(this, e.Events), this.setMuteCallback = function() {
                    a.handleMute ? a.setMute() : a.handleMute = !0
                }, this.playerContainer = this.player.getContainer(), n.adOptOut ? setTimeout(function() {
                    a.sendEvent("error", {
                        message: "Conditional ad rejected",
                        code: 408
                    })
                }, 0) : this.iframe = function(e, t, i, r) {
                    var n = document.createElement("iframe");
                    n.setAttribute("gesture", "media"), n.setAttribute("allow", "autoplay"), n.src = "javascript:false", e.style(n, {
                        border: 0,
                        width: "100%",
                        height: "100%",
                        position: "absolute",
                        overflow: "hidden"
                    }), n.scrolling = "no", i.querySelector(".jw-media").appendChild(n);
                    var a = n.contentWindow.document;
                    return a.open().write("\n    <body onload=\"\n        var js = document.createElement('script');\n        js.src = '" + t + "';\n        js.addEventListener('load', function() { window.myCallback(); });\n        document.body.appendChild(js);\"\n    style=\"margin: 0\">"), n.contentWindow.myCallback = r, a.close(), n
                }(e.utils, this.vpaidURL, this.playerContainer, this.callback.bind(this))
            }
            return s.prototype.sendEvent = function(e, t) {
                (t = t || {}).tag || (t.tag = this.adTag), this.trigger(e, t)
            }, s.prototype.sendTimeEvent = function(e, t, i) {
                var r = t.getAdDuration(),
                    n = t.getAdRemainingTime(),
                    a = _e({
                        duration: r
                    }, i);
                this.sendEvent(e, a), 0 < n && (a.position = r - n, this.trigger("time", a))
            }, s.prototype.handleQuartile = function(e, t) {
                this.sendTimeEvent("quartile", e, {
                    quartile: t
                })
            }, s.prototype.genEvent = function(t) {
                var i = this;
                return function(e) {
                    i.on(t, e)
                }
            }, s.prototype.setMute = function() {
                var e = 0 === this.vpaidAd.getAdVolume();
                this.player.getMute() !== e && this.player.setMute(e)
            }, s.prototype.userActive = function() {
                var e = this.player.utils.hasClass(this.playerContainer, "jw-flag-time-slider-above");
                this.player.utils.style(this.iframe, {
                    bottom: e ? 66 : 60
                })
            }, s.prototype.userInactive = function() {
                "paused" !== this.player.getState() && this.player.utils.style(this.iframe, {
                    bottom: "0.5em"
                })
            }, s.prototype.prepareNonlinearAd = function() {
                var e = !this.player.utils.hasClass(this.playerContainer, "jw-flag-user-inactive");
                if (this.player.utils.style(this.iframe, {
                        height: 150
                    }), this.resize(null, 150), this.userActive(e), this.player.on("userActive", this.userActive, this), this.player.on("userInactive", this.userInactive, this), this.instream) {
                    this.instream.noResume = !0, this.instream.applyProviderListeners(null), this.instream.destroy(), this.instream = null;
                    var t = this.playerContainer.querySelector(".jw-media"),
                        i = t.querySelector("video,audio");
                    t.insertBefore(i, this.iframe), i.play()
                }
            }, s.prototype.progressInterval = function(t) {
                var i = this;
                if (clearInterval(this.remainingTimeInterval), t && t.getAdRemainingTime) {
                    var r = -1;
                    this.remainingTimeInterval = setInterval(function() {
                        var e = t.getAdRemainingTime();
                        isNaN(e) || e <= 0 || r === e || (r = e, i.sendTimeEvent("remainingTimeChange", t, {
                            remainingTime: e
                        }))
                    }, 250)
                }
            }, s.prototype.genListeners = function(e) {
                var r = this;
                return {
                    AdLoaded: function() {
                        e.setAdVolume(r.getPlayerVolume()), e.startAd()
                    },
                    AdStarted: function() {
                        e.getAdLinear() ? r.vpaidControls ? r.progressInterval(e) : (r.instream = r.instream || r.player.createInstream(), r.instream.hide()) : r.prepareNonlinearAd(), r.sendEvent("impression", {
                            linear: e.getAdLinear() ? "linear" : "nonlinear"
                        }), r.sendEvent("play", {
                            oldstate: "buffering",
                            newstate: ue,
                            linear: e.getAdLinear() ? "linear" : "nonlinear"
                        }), r.handleMute = !0, e.subscribe(r.setMuteCallback, "AdVolumeChange", e)
                    },
                    AdVideoStart: function() {
                        r.sendEvent("started")
                    },
                    AdStopped: function() {
                        r.sendEvent("stopped")
                    },
                    AdPaused: function() {
                        r.paused || (r.paused = !0, r.sendEvent("pause", {
                            newstate: l,
                            oldstate: ue
                        }))
                    },
                    AdPlaying: function() {
                        r.paused && (r.paused = !1, r.sendEvent("play", {
                            newstate: ue,
                            oldstate: l,
                            linear: e.getAdLinear() ? "linear" : "nonlinear"
                        }))
                    },
                    AdLinearChange: function() {
                        e.getAdLinear() ? (r.player.utils.style(r.iframe, {
                            height: "100%"
                        }), r.player.off(null, null, r), r.instream = r.instream || r.player.createInstream(), r.instream.init(), r.vpaidControls || r.instream.hide()) : r.prepareNonlinearAd()
                    },
                    AdDurationChange: function() {
                        r.sendTimeEvent("remainingTimeChange", e, {
                            isDurationChange: !0,
                            remainingTime: e.getAdRemainingTime()
                        })
                    },
                    AdRemainingTimeChange: function() {
                        r.sendTimeEvent("remainingTimeChange", e, {
                            remainingTime: e.getAdRemainingTime()
                        })
                    },
                    AdExpandedChange: function() {
                        r.sendEvent("expandedChange", {
                            expanded: e.getAdExpanded()
                        })
                    },
                    AdSkipped: function() {
                        r.sendEvent("skipped")
                    },
                    AdVideoFirstQuartile: function() {
                        r.handleQuartile(e, 1)
                    },
                    AdVideoMidpoint: function() {
                        r.handleQuartile(e, 2)
                    },
                    AdVideoThirdQuartile: function() {
                        r.handleQuartile(e, 3)
                    },
                    AdVideoComplete: function() {
                        r.sendEvent("complete")
                    },
                    AdUserClose: function() {
                        r.sendEvent("close")
                    },
                    AdClickThru: function(e, t, i) {
                        r.sendEvent("click", {
                            id: t,
                            url: e,
                            playerHandles: i
                        })
                    },
                    AdError: function(e) {
                        var t = function(e) {
                            if (e) {
                                var t = e.match(/\b(?:[34])[0-9]{2}\b/);
                                if (t) return parseInt(t[0], 10);
                                if (e.match(/timeout/i)) return e.match(/vpaid|vast/i) ? 301 : 402;
                                if (e.match(/found/i)) return 401;
                                if (e.match(/supported/i)) return 403;
                                if (e.match(/(?:displaying|media file)/i)) return 405
                            }
                            return 901
                        }(e);
                        r.sendEvent("error", {
                            message: e,
                            code: t,
                            adErrorCode: 5e4 + t
                        })
                    }
                }
            }, s.prototype.callback = function() {
                try {
                    this.vpaidAd = this.iframe.contentWindow.getVPAIDAd();
                    var e = this.vpaidAd.handshakeVersion("2.0");
                    if (parseFloat(e) < 1) throw new Error("Invalid vpaid version in handshake")
                } catch (e) {
                    return void this.sendEvent("error", {
                        message: "VPAID general error",
                        code: 901,
                        adErrorCode: 51901
                    })
                }
                var t = this.vpaidAd,
                    i = this.genListeners(t);
                Object.keys(i).forEach(function(e) {
                    t.subscribe(i[e], e, t)
                }), this.listeners = i;
                var r = {
                        AdParameters: this.adParams
                    },
                    n = this.playerContainer.querySelector(".jw-media"),
                    a = this.instream.getMediaElement(),
                    s = this.iframe.contentWindow.document.createElement("div");
                s.className = "jw-vpaid-wrapper", s.style.height = "100%", this.iframe.contentWindow.document.body.appendChild(s);
                var o = {
                    videoSlot: a,
                    slot: s
                };
                t.initAd(n.clientWidth, n.clientHeight, "normal", 1e3, r, o), t.setAdVolume(this.getPlayerVolume())
            }, s.prototype.play = function() {
                this.vpaidAd.resumeAd()
            }, s.prototype.pause = function() {
                this.vpaidAd.pauseAd()
            }, s.prototype.stop = function() {
                if (this.vpaidAd) try {
                    this.vpaidAd.stopAd()
                } catch (e) {}
            }, s.prototype.getPlayerVolume = function() {
                return this.player.getMute() ? 0 : this.player.getVolume() / 100
            }, s.prototype.setVolume = function(e) {
                this.handleMute = !1, this.vpaidAd.setAdVolume(e / 100)
            }, s.prototype.resize = function(e, t) {
                if (this.vpaidAd && this.vpaidAd.resizeAd) {
                    var i = this.player.getFullscreen() || document.fullScreen || document.mozFullScreen || document.webkitIsFullScreen ? "fullscreen" : "normal";
                    this.vpaidAd.resizeAd(e || this.player.getWidth(), t || this.player.getHeight(), i)
                }
            }, s.prototype.destroy = function() {
                if (this.removeEvents(), clearInterval(this.remainingTimeInterval), this.vpaidAd) try {
                    var t = this.listeners,
                        i = this.vpaidAd;
                    Object.keys(t).forEach(function(e) {
                        i.unsubscribe(t[e], e, i)
                    }), i.unsubscribe(this.setMuteCallback, "AdVolumeChange", i)
                } catch (e) {}
                this.iframe && this.iframe.parentNode && this.iframe.parentNode.removeChild(this.iframe), this.vpaidAd = null, this.player = null, this.instream = null
            }, s.prototype.removeEvents = function() {
                this.player && this.player.off(null, null, this), this.off()
            }, s.prototype.attachMedia = function() {}, s.prototype.detachMedia = function() {}, s.prototype.volume = function() {}, s.prototype.mute = function() {}, s.prototype.getState = function() {
                return this.vpaidState.linear ? this.paused ? l : ue : "idle"
            }, s
        }();
    var Te = {},
        k = [];
    var b = function() {
        function o(e, t, i, r) {
            var n = this;
            y(this, o);
            var a, s = e || {};
            this.map = s, this.debugTrackFn = t, this.trackerPlayerUtils = (a = i, {
                getPosition: function() {
                    return a.getPosition()
                },
                getFile: function() {
                    return a.getPlaylistItem().file
                }
            }), this.trackingFilter = r, this.lastQuartile = 0, this.progressEvents = [], this.breakStarted = !1, this.started = !1, this.firedError = !1, this.hasComp = !1, Te._.map(s, function(e, t) {
                if (s.hasOwnProperty(t) && 0 === t.indexOf("progress")) {
                    var i = "" + t.split("_")[1],
                        r = {
                            key: t,
                            offset: i,
                            tracked: !1,
                            percentage: !1
                        };
                    /^\d+%$/.test(i) ? (r.percentage = !0, r.offset = parseFloat(i)) : r.offset = Te.utils.seconds(i), n.progressEvents.push(r)
                }
            }), this.setFactories()
        }
        return o.prototype.getUrls = function(e) {
            return this.map.hasOwnProperty(e) ? this.map[e] : []
        }, o.prototype.addUrl = function(e, t) {
            this.map.hasOwnProperty(e) || (this.map[e] = []), this.map[e].push(t)
        }, o.prototype.trackPings = function(e) {
            var t = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : {},
                i = this.getUrls(e),
                r = this.trackingFilter,
                n = [],
                a = [],
                s = [];
            if (i.length) {
                t = this.replaceMacros(t), i.forEach(function(i) {
                    if (i) {
                        if (Te._.each(t, function(e, t) {
                                i = i.replace(t, e)
                            }), r && !1 === r(i)) return void a.push(i);
                        var e = new Image;
                        e.src = i, n.push(i), s.push(e)
                    }
                }), Array.prototype.push.apply(k, s);
                for (var o = k.length; o-- && (k[o].width || k[o].complete);) k.length = o
            }
            "function" == typeof this.debugTrackFn && this.debugTrackFn({
                type: "ping",
                data: {
                    pingType: e,
                    urls: n,
                    filteredUrls: a,
                    images: s
                }
            })
        }, o.prototype.replaceMacros = function(e) {
            var t, i, r, n, a, s, o;
            return e["[TIMESTAMP]"] = encodeURIComponent((t = new Date, i = t.getTime(), r = t.getTimezoneOffset() / 60, n = 6e4 * t.getTimezoneOffset(), new Date(i - n).toISOString().slice(0, -1) + (0 < r ? "-" : "+") + ("0" + r).slice(-2))), e["[CACHEBUSTING]"] = Math.random().toString().slice(2, 10), e["[ASSETURI]"] = encodeURIComponent(this.trackerPlayerUtils.getFile()), e["[CONTENTPLAYHEAD]"] = encodeURIComponent((a = this.trackerPlayerUtils.getPosition(), s = ("0" + Math.floor(a / 3600)).slice(-2), o = ("0" + Math.floor((a - 3600 * s) / 60)).slice(-2), s + ":" + o + ":" + ("0" + Math.floor(a - 3600 * s - 60 * o)).slice(-2) + "." + (a % 1).toFixed(3).toString().slice(2, 5))), e
        }, o.prototype.start = function() {
            this.started = !0, this.trackPings("start")
        }, o.prototype.breakStart = function() {
            this.breakStarted = !0, this.trackPings("breakStart")
        }, o.prototype.time = function(e, t) {
            if (!(t <= 1)) {
                for (var i = (4 * e + .05) / t | 0; i > this.lastQuartile && this.lastQuartile < 3;) this.lastQuartile++, 1 === this.lastQuartile ? this.trackPings("firstQuartile") : 2 === this.lastQuartile ? this.trackPings("midpoint") : 3 === this.lastQuartile && this.trackPings("thirdQuartile");
                this.trackProgress(e, t)
            }
        }, o.prototype.trackProgress = function(e, t) {
            for (var i = this.progressEvents.length; i--;) {
                var r = this.progressEvents[i];
                if (!r.tracked) {
                    var n = r.offset;
                    r.percentage && (n = t * n / 100), n <= e && (r.tracked = !0, this.trackPings(r.key))
                }
            }
        }, o.prototype.error = function() {
            var e = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : 900;
            this.firedError = !0;
            var t = {};
            t[d] = e, this.trackPings("error", t)
        }, o.prototype.factory = function(e) {
            var t = this;
            return function() {
                t.trackPings(e)
            }
        }, o.prototype.setFactories = function() {
            this.creativeView = this.factory("creativeView"), this.click = this.factory("click"), this.skip = this.factory("skip"), this.complete = this.factory("complete"), this.pause = this.factory("pause"), this.resume = this.factory("resume"), this.mute = this.factory("mute"), this.unmute = this.factory("unmute"), this.fullscreen = this.factory("fullscreen"), this.expand = this.factory("expand"), this.collapse = this.factory("collapse"), this.acceptInvitation = this.factory("acceptInvitation"), this.close = this.factory("close"), this.rewind = this.factory("rewind"), this.impression = this.factory("impression"), this.breakEnd = this.factory("breakEnd")
        }, o
    }();

    function Ie(e, t, i) {
        var r = {};
        return r.message = e, r.code = t && 100 <= t && t <= 1008 ? t : 900, r.adErrorCode = i || 60900, r
    }

    function Ee(e) {
        return new Array(e + 1).join((Math.random().toString(36) + "00000000000000000").slice(2, 18)).slice(0, e)
    }

    function w(e, t) {
        e.wrappedTags && (t.wrapperAdSystem = e.wrapper || "", t.tag = e.wrappedTags.pop(), t.wrappedTags = e.wrappedTags), t.adsystem = e.adsystem || ""
    }

    function Ce(e, t, i) {
        var r = e.vmap ? e.vmap : e.adschedule || e.adbreak;
        if (r && i[r.breakid]) {
            var n = i[r.breakid],
                a = n.bid.getEventObject(te, n.bidders, e);
            e.bidsVersion = a.bidsVersion, e.mediationLayerAdServer = a.mediationLayerAdServer, e.bidders = a.bidders, void 0 !== a.floorPriceCents && (e.floorPriceCents = a.floorPriceCents)
        }
        return e
    }
    var Se = function() {
        function s(e, t, i, r, n, a) {
            y(this, s), this.player = t, this.staticPlayer = i, this.companion = r, this.playlistItemManager = n, this.optionalParams = a, this.debugTrackFn = a.debugTrackFn, this.scheduledAd = e.scheduledAd(), this.vastBuffet = e.adBuffet(), this.vastAdPod = e.adPod(), this.vastAd = this.vastBuffet.length ? this.vastBuffet[0] : null, this.adType = null, this.vpaidPlayer = null, this.instreamPlayer = null, this.blockingInstreamPlayer = null, this.mediaType = null, this.adPodItems = null, this.creativeTimeout = null, this.vastOptions = null, this.duration = 0, this.position = 0, this.adPodIndex = 0, this.initialIndex = 0, this.viewablePlayedTime = 0, this.adViewableImpressionHandler = t.utils.noop, this.lastPosition = null, this.reason = null, _e(this, t.Events)
        }
        return s.prototype.init = function(e, t) {
            return this.init = function() {
                throw new Error("Adplayer can only be initialized once")
            }, this.blockingInstreamPlayer = e, this.reason = t, !!this.prepareAdPod() && (this.player.on("fullscreen", this.playerFullscreenHandler, this), this.player.on("volume", this.playerVolumeHandler, this), this.player.on("mute", this.muteHandler, this), this.player.on("resize", this.playerResizeHandler, this), this.playAd())
        }, s.prototype.prepareAdPod = function() {
            var t = this,
                e = null,
                i = 0,
                r = [];
            if (this.vastAd && (S(this.vastAd, this.debugTrackFn, this.player, this.optionalParams.trackingFilter), (e = this.prepareAdPodItem(this.vastAd)) && "vpaid" === e.adType && !C(this.vastAd) && (e = null)), this.vastAdPod)
                for (var n = null, a = 0; a < this.vastAdPod.length; a++) {
                    var s = this.vastAdPod[a];
                    S(s, this.debugTrackFn, this.player, this.optionalParams.trackingFilter);
                    var o = this.prepareAdPodItem(s);
                    if (o) {
                        if (n !== o.adType && "instream" === n) break;
                        if (n = o.adType, "vpaid" !== o.adType || C(s)) {
                            var d = r.length + i === a;
                            o && d && r.push(o)
                        } else i++
                    } else i++
                }
            if (!r.length && !e) return this.adError("No Compatible Creatives", 403), !1;
            var l = void 0;
            return r.length ? (l = r, this.vastOptions = [], l.forEach(function(e) {
                t.vastOptions.push(t.getInstreamOptions(e.vastAd))
            })) : (l = e, this.vastOptions = this.getInstreamOptions(this.vastAd)), this.adPodItems = l, !(this.adPodIndex = 0)
        }, s.prototype.prepareAdPodItem = function(e) {
            e.tracker.linear = "linear";
            var t = ("" + e.media[0].adType).toLowerCase() || "instream";
            "vpaid" !== t || C(e) || (t = "instream");
            var i = {
                vastAd: e,
                sources: [],
                adType: t
            };
            this.scheduledAd.skipoffset && (i.skipoffset = this.scheduledAd.skipoffset);
            var r = e.media,
                n = {};
            if (Te._.each(r, function(e) {
                    i.sources.push({
                        file: e.file,
                        mimeType: e.type,
                        type: ("" + e.type).replace(/^(?:video|audio)\/(?:x-)?/, "")
                    }), n[e.file] = {
                        width: e.width || 0,
                        height: e.height || 0
                    }
                }), "instream" === t && (i.sources = function(e) {
                    var i = void 0;
                    i = jwplayer.api.availableProviders.filter(function(e) {
                        return "flash" !== e.name
                    });
                    var t = e.filter(function(t) {
                            return i.some(function(e) {
                                return e.supports(t)
                            })
                        }),
                        r = t.filter(function(e) {
                            return "3gpp" !== e.type
                        });
                    return r.length ? r : t
                }(i.sources)), 0 === i.sources.length) return null;
            this.mediaType = ("" + i.sources[0].mimeType).toLowerCase(), i.vastAd.selectedMedia = i.sources[0];
            var a = this.player.getSafeRegion(!0),
                s = null,
                o = null;
            return i.sources.forEach(function(e) {
                var t = n[e.file];
                t.width <= a.width && (!s || t.width > n[s.file].width) && (s = e), t.width >= a.width && (!o || t.width < n[o.file].width) && (o = e)
            }), s ? (i.vastAd.selectedMedia = s).default = !0 : o && ((i.vastAd.selectedMedia = o).default = !0), i
        }, s.prototype.getInstreamOptions = function(e) {
            var t = 0 <= this.optionalParams.skipoffset ? this.optionalParams.skipoffset : null;
            return {
                skipoffset: e.skipoffset || this.scheduledAd.skipoffset || t,
                skipMessage: this.optionalParams.skipMessage,
                skipText: this.optionalParams.skipText
            }
        }, s.prototype.getVastAd = function(e) {
            if (this.adPodItems) {
                var t = void 0;
                if ((t = this.adPodItems.length ? this.adPodItems[e] : this.adPodItems).vastAd) return t.vastAd
            } else if (this.vastAdPod && this.vastAdPod.length) return this.vastAdPod[e];
            return this.vastAd
        }, s.prototype.adError = function(e, t, i) {
            clearTimeout(this.creativeTimeout);
            var r = this.getVastAd(this.adPodIndex);
            t = t || 900;
            var n = "vpaid" === this.adType ? 5e4 : 1e4,
                a = Ie(e, t, i = i || n + t);
            (a.creativeId = r.creativeId || "", _(r, a), T(r, a), this.vastAdPod && this.adPodIndex < this.vastAdPod.length - 1) ? this.triggerEvent("adPodError", a): (r.tracker.error(a.code), w(r, a), this.addConditionalAdData(a), this.triggerEvent(ge, a))
        }, s.prototype.playAd = function() {
            var e = this.adPodItems[this.adPodIndex] || this.adPodItems;
            if (this.adType = e.adType, this.blockingInstreamPlayer) {
                var t = this.optionalParams.loadingAd;
                this.blockingInstreamPlayer.setText(t)
            }
            if ("vpaid" === this.adType) return this.playVpaid(e.vastAd);
            if ("static" === this.adType) return this.playStatic(), !0;
            var i = Array.isArray(this.adPodItems) ? this.adPodItems.slice(this.adPodIndex) : this.adPodItems,
                r = Array.isArray(this.vastOptions) ? this.vastOptions.slice(this.adPodIndex) : this.vastOptions;
            return this.initialIndex = this.adPodIndex, this.playInstream(i, r)
        }, s.prototype.clearVpaidBlocking = function() {
            if (this.vpaidPlayer.instream) {
                var e = this.vpaidPlayer.instream;
                this.vpaidPlayer.instream = null, this.clearBlocking(e)
            }
        }, s.prototype.clearBlocking = function(e) {
            (e = e || this.blockingInstreamPlayer) && e !== this.instreamPlayer && e.destroy()
        }, s.prototype.getState = function() {
            return this.instreamPlayer ? this.instreamPlayer.getState() : this.vpaidPlayer ? this.vpaidPlayer.getState() : ""
        }, s.prototype.clearNonlinear = function() {
            this.staticPlayer.stop(), this.vpaidPlayer && (this.clearVpaidBlocking(), this.vpaidPlayer && (this.vpaidPlayer.stop(), this.vpaidPlayer.destroy(), this.vpaidPlayer = null))
        }, s.prototype.destroy = function() {
            if (clearTimeout(this.creativeTimeout), this.off(), this.removePlayerListeners(), clearTimeout(this.creativeTimeout), this.instreamPlayer) {
                var e = this.instreamPlayer;
                this.instreamPlayer = null, this.clearBlocking(e)
            }
            this.vpaidPlayer && (this.clearVpaidBlocking(), this.vpaidPlayer && (this.vpaidPlayer.destroy(), this.vpaidPlayer = null)), this.clearNonlinear(), this.player = null, this.instreamPlayer = null, this.scheduledAd = null, this.vastBuffet = null, this.vastAd = null, this.vastAdPod = null
        }, s.prototype.pause = function(e) {
            var t = e.reason;
            this.reason = t || we, this.instreamPlayer ? this.instreamPlayer.pause() : this.vpaidPlayer && this.vpaidPlayer.pause()
        }, s.prototype.play = function(e) {
            var t = e.reason;
            this.reason = t || we, this.instreamPlayer ? this.instreamPlayer.play() : this.vpaidPlayer && this.vpaidPlayer.play()
        }, s.prototype.removePlayerListeners = function() {
            this.player && (this.player.off("fullscreen", this.playerFullscreenHandler, this), this.player.off("volume", this.playerVolumeHandler, this), this.player.off("mute", this.muteHandler, this), this.player.off(r, this.viewableHandler, this)), this.instreamPlayer && this.instreamPlayer.off(null, null, this), this.vpaidPlayer && (this.vpaidPlayer.removeEvents(), this.clearVpaidBlocking(), this.vpaidPlayer && (this.vpaidPlayer.destroy(), this.vpaidPlayer = null)), this.staticPlayer.stop(), this.staticPlayer.removeEvents()
        }, s.prototype.adEventObject = function(e) {
            var t = this.playlistItemManager.getAdEventObject(this.scheduledAd);
            if (t.viewable = this.player.getViewable(), this.adPodItems && this.adPodItems.length && (t.sequence = this.adPodIndex + 1, t.podcount = this.adPodItems.length), this.mediaType && (t.creativetype = this.mediaType), this.scheduledAd._vmap && (t.vmap = this.scheduledAd._vmap), -1 !== g.indexOf(e)) {
                var i = this.getVastAd(this.adPodIndex);
                t.universalAdIdRegistry = i.universalAdIdRegistry, t.universalAdIdValue = i.universalAdIdValue, t.categories = i.categories
            }
            return t
        }, s.prototype.playStatic = function() {
            this.vastAd.tracker.linear = "nonlinear";
            var e = this.vastAd.media[0];
            this.vastAd.selectedMedia = e;
            var t = this.vastAd.clickthrough || "",
                i = this.staticPlayer;
            i.removeEvents(), i.on("play", this.impressionHandler, this), i.on("play", this.playHandler, this), i.on("complete", this.combinedCompleteHandler, this), i.on("click", this.clickStaticHandler, this), i.on("error", this.staticErrorHandler, this), this.playlistItemManager.addStaticOffset(this.scheduledAd._offSet), i.playAd(e.file, t, e.minDuration, this.scheduledAd._currentTag, this.scheduledAd.requestTimeout), this.clearBlocking()
        }, s.prototype.creativeAdError = function(e, t, i) {
            this.adError(e, t, i), this.adPodItems && this.adPodItems.length - 1 > this.adPodIndex && (this.vpaidPlayer && (this.vpaidPlayer.destroy(), this.vpaidPlayer = null), this.adPodIndex++, this.scheduledAd._adPodIndex = this.adPodIndex, this.playAd())
        }, s.prototype.playVpaid = function(e) {
            var t = this;
            clearTimeout(this.creativeTimeout), this.creativeTimeout = setTimeout(function() {
                t.creativeAdError("VPAID tag communication timeout", 900, 50004)
            }, this.scheduledAd.creativeTimeout);
            var i = C(this.vastAd = e),
                r = this.optionalParams.conditionaladoptout && e.conditionalAd;
            if (this.vastAd.selectedMedia = i, this.mediaType = i.type, "flash" === I(i)) return this.creativeAdError("Flash creatives are not supported", 403, 10403), !1;
            var n = {
                adParams: this.vastAd.adParams,
                vpaidControls: this.optionalParams.vpaidcontrols,
                adOptOut: r
            };
            return this.vpaidPlayer = new P(this.player, this.blockingInstreamPlayer, i.file, this.scheduledAd._currentTag, n), this.blockingInstreamPlayer && this.blockingInstreamPlayer.applyProviderListeners(this.vpaidPlayer), this.vpaidPlayer.on("play", this.playHandler, this), this.vpaidPlayer.on("pause", this.pauseHandler, this), this.vpaidPlayer.on("quartile", this.quartileHandler, this), this.vpaidPlayer.on("remainingTimeChange", this.remainingTimeHandler, this), this.vpaidPlayer.on("click", this.clickVpaidHandler, this), this.vpaidPlayer.on("error", this.playbackErrorHandler, this), this.vpaidPlayer.on("impression", this.impressionHandler, this), this.vpaidPlayer.on("expandedChange", this.vpaidExpandedHandler, this), this.vpaidPlayer.on("close", this.adCloseHandler, this), this.vpaidPlayer.on("skipped", this.vpaidAdSkipped, this), this.vpaidPlayer.on("stopped", this.endOfVpaidAdHandler, this), this.vpaidPlayer.on("complete", this.adCompleteHandler, this), this.vpaidPlayer.on("started", this.adStartedHandler, this), this.setupSkipButton(e), !0
        }, s.prototype.setupSkipButton = function(e) {
            var t = "skipoffset" in e ? Te.utils.seconds(e.skipoffset) : -1,
                i = 0 <= this.optionalParams.skipoffset ? this.optionalParams.skipoffset : t;
            0 <= i && this.blockingInstreamPlayer && (this.blockingInstreamPlayer.off(be, this.skipVpaidAd, this), this.blockingInstreamPlayer.setupSkipButton(i, this.optionalParams, Te.utils.noop), this.blockingInstreamPlayer.on(be, this.skipVpaidAd, this))
        }, s.prototype.playInstream = function(e, t) {
            var i = this,
                r = this.player.getEnvironment().OS;
            return r.android && 2 === r.version.major && 3 === r.version.minor ? (this.adError("Android 2.3 not supported", 900, 60007), !1) : (clearTimeout(this.creativeTimeout), this.creativeTimeout = setTimeout(function() {
                i.creativeAdError("Video creative timeout", 402, 10402)
            }, this.scheduledAd.creativeTimeout), this.blockingInstreamPlayer ? this.instreamPlayer = this.blockingInstreamPlayer : this.instreamPlayer = this.player.createInstream().init(), this.instreamPlayer.on("play", this.playHandler, this), this.instreamPlayer.on("pause", this.pauseHandler, this), this.instreamPlayer.on("time", this.timeHandler, this), this.instreamPlayer.on("playlistItem", this.playlistItemHandler, this), this.instreamPlayer.on("complete", this.adCompleteHandler, this), this.instreamPlayer.on("playlistComplete", this.endOfAdBreakHandler, this), this.instreamPlayer.on("mute", this.muteHandler, this), this.instreamPlayer.on("instreamClick", this.clickInstreamHandler, this), this.instreamPlayer.on("adSkipped", this.adSkipped, this), this.instreamPlayer.on("error", this.playbackErrorHandler, this), this.instreamPlayer.on("mediaError", this.playbackErrorHandler, this), this.instreamPlayer.on("destroyed", function() {
                i.instreamPlayer = null
            }, this), this.instreamPlayer.loadItem(e, t), this.clearBlocking(), !0)
        }, s.prototype.playerFullscreenHandler = function(e) {
            var t = this.getVastAd(this.adPodIndex).tracker;
            e.fullscreen && t.started && t.fullscreen()
        }, s.prototype.playerResizeHandler = function(e) {
            this.vpaidPlayer && this.vpaidPlayer.resize(e.width, e.height)
        }, s.prototype.playerVolumeHandler = function(e) {
            this.vpaidPlayer && this.vpaidPlayer.setVolume(e.volume)
        }, s.prototype.playlistItemHandler = function(e) {
            this.instreamPlayer && (this.scheduledAd._adPodIndex = this.adPodIndex = e.index + this.initialIndex)
        }, s.prototype.impressionHandler = function(e) {
            var t = this.getVastAd(this.adPodIndex),
                i = t.tracker;
            i.impression();
            var r = {};
            r.adposition = this.scheduledAd._position || "", r.adtitle = t.adTitle || "", r.creativeId = t.creativeId || "", w(t, r), r.vastversion = t.vastversion, r.clickThroughUrl = t.clickthrough, r.duration = t.duration || 0, r.mediafile = {
                file: t.selectedMedia.file
            }, r.linear = e.linear || i.linear, this.addConditionalAdData(r), _(t, r), T(t, r), this.triggerEvent(ye, r), this.setupViewableListener()
        }, s.prototype.setupViewableListener = function() {
            this.player.off(r, this.viewableHandler, this), this.player.on(r, this.viewableHandler, this), this.viewableHandler({
                viewable: this.player.getViewable()
            })
        }, s.prototype.viewableHandler = function(e) {
            e.viewable ? (this.viewablePlayedTime = 0, this.lastPosition = null, this.adViewableImpressionHandler = this.adViewableHandler) : this.adViewableImpressionHandler = this.player.utils.noop
        }, s.prototype.playHandler = function(e) {
            clearTimeout(this.creativeTimeout);
            var t, i, r = this.getVastAd(this.adPodIndex),
                n = r.tracker,
                a = void 0;
            if (n.started) e.oldstate === l && (n.resume(), this.dispatchPlay(e));
            else {
                this.vpaidPlayer && (n.linear = e.linear), this.instreamPlayer && this.impressionHandler({
                    linear: n.linear
                });
                var s = _e({
                    linear: n.linear
                }, this.getInstreamOptions(r));
                s.adMessage = this.optionalParams.dynamicMessage || "", s.clickThroughUrl = r.clickthrough, s.sequence && (s.podMessage = this.optionalParams.podMessage || ""), r.adTitle && (s.adtitle = r.adTitle), r.companions && (s.companions = r.companions), T(r, s), this.triggerEvent(u, s), r.companions && ((a = {}).companions = (i = r.companions, Te._.map(i, function(e) {
                    var t = "iframe" === e.type || "html" === e.type ? e.type : "static",
                        i = void 0;
                    return e.trackers && e.trackers.creativeView && e.trackers.creativeView.length && (i = e.trackers.creativeView), {
                        width: e.width,
                        height: e.height,
                        type: t,
                        resource: e.source,
                        creativeview: i,
                        click: e.clickthrough
                    }
                })), a.universalAdIdRegistry = r.companionUniversalAdIdRegistry, a.universalAdIdValue = r.companionUniversalAdIdValue, this.triggerEvent("adCompanions", a));
                var o = this.companion,
                    d = void 0;
                9 < Te.utils.flashVersion() ? d = r.companions : (t = r.companions, d = Te._.filter(t, function(e) {
                    return e.type.indexOf("flash") < 0
                })), this.optionalParams.companion && d && d.length && (n.hasComp = o.addCompanion(this.optionalParams.companion, d)), n.start(), n.creativeView(), this.dispatchPlay(e)
            }
        }, s.prototype.dispatchPlay = function(e) {
            "static" === this.adType || "vpaid" === this.adType && "linear" !== e.linear || (null === this.reason && "vpaid" === this.adType && (this.reason = i), this.setState(e))
        }, s.prototype.pauseHandler = function(e) {
            clearTimeout(this.creativeTimeout), this.getVastAd(this.adPodIndex).tracker.pause(), null === this.reason && "vpaid" === this.adType && (this.reason = i), this.setState(e)
        }, s.prototype.setState = function(e) {
            var t = e.newstate,
                i = t === ue,
                r = this.adEventObject(i ? p : o);
            (r.newstate = t, null !== this.reason) && (r[i ? "playReason" : "pauseReason"] = this.reason, this.reason = null);
            this.vpaidPlayer ? this.vpaidPlayer.trigger("state", r) : this.instreamPlayer.setEventData(r)
        }, s.prototype.remainingTimeHandler = function(e) {
            e.duration ? this.duration = e.duration : this.duration = Math.max(1, this.duration, e.remainingTime);
            var t = 0 <= e.remainingTime ? this.duration - e.remainingTime : 0;
            this.timeHandler({
                position: t,
                duration: this.duration,
                isDurationChange: e.isDurationChange
            })
        }, s.prototype.quartileHandler = function(e) {
            if (e.duration) this.duration = e.duration;
            else {
                var t = 4 * e.remainingTime / (4 - e.quartile);
                this.duration = Math.max(this.duration, 1, t)
            }
            this.timeHandler({
                position: this.duration * e.quartile * .25,
                duration: this.duration
            })
        }, s.prototype.adViewableHandler = function(e) {
            var t = e.position;
            null === this.lastPosition && (this.lastPosition = t);
            var i = t - this.lastPosition;
            this.lastPosition = t, i = Math.min(Math.max(0, i), 4), this.viewablePlayedTime += i, 2 <= this.viewablePlayedTime && (this.player.off(r, this.viewableHandler, this), this.adViewableImpressionHandler = this.player.utils.noop, this.triggerEvent("adViewableImpression", {}))
        }, s.prototype.timeHandler = function(e) {
            var t = this.getVastAd(this.adPodIndex),
                i = e.position,
                r = e.duration;
            this.adViewableImpressionHandler(e);
            var n = r - i,
                a = t.tracker,
                s = this.optionalParams.dynamicMessage || "",
                o = this.optionalParams.podMessage || "";
            if (s && 0 < n) {
                if (s = s.replace(/(\b)xx(s?\b)/gi, "$1" + Math.ceil(n) + "$2"), this.adPodItems && 1 < this.adPodItems.length && o) {
                    var d = this.adPodIndex + 1;
                    s = (o = (o = o.replace(/__AD_POD_CURRENT__/g, "" + d)).replace(/__AD_POD_LENGTH__/g, "" + this.adPodItems.length)) + " " + s
                }
                this.instreamPlayer ? this.instreamPlayer.setText(s) : this.vpaidPlayer && this.vpaidPlayer.instream && this.vpaidPlayer.instream.setText(s)
            }
            if (!e.isDurationChange) {
                a && a.time(i, r);
                var l = {};
                l.position = this.position = i, l.duration = r, this.triggerEvent("adTime", l)
            }
        }, s.prototype.combinedCompleteHandler = function() {
            this.adCompleteHandler(), this.endOfAdBreakHandler()
        }, s.prototype.adCompleteHandler = function() {
            clearTimeout(this.viewableTimeout);
            var e = this.getVastAd(this.adPodIndex).tracker;
            e.firedError || (e.complete(), this.triggerEvent(ve))
        }, s.prototype.adCloseHandler = function() {
            clearTimeout(this.viewableTimeout);
            var e = this.getVastAd(this.adPodIndex).tracker;
            e.firedError || e.close()
        }, s.prototype.adStartedHandler = function() {
            this.triggerEvent(e)
        }, s.prototype.endOfVpaidAdHandler = function() {
            if (clearTimeout(this.viewableTimeout), this.adPodItems && this.adPodItems.length - 1 > this.adPodIndex) return this.vpaidPlayer && (this.vpaidPlayer.destroy(), this.vpaidPlayer = null), this.adPodIndex++, void this.playAd();
            this.endOfAdBreakHandler()
        }, s.prototype.endOfAdBreakHandler = function() {
            this.removePlayerListeners(), this.trigger(ve)
        }, s.prototype.muteHandler = function(e) {
            var t = this.getVastAd(this.adPodIndex).tracker;
            t && (e.mute ? t.mute() : t.unmute(), this.vpaidPlayer && this.vpaidPlayer.setVolume(e.mute ? 0 : this.player.getVolume()))
        }, s.prototype.clickStaticHandler = function() {
            var e = this.getVastAd(this.adPodIndex);
            this.player.pause({
                reason: h
            }), this.clickThrough(e)
        }, s.prototype.clickVpaidHandler = function(e) {
            var t = this.getVastAd(this.adPodIndex),
                i = !0;
            e && void 0 !== e.url && (!1 === e.playerHandles && (i = !1), t.clickthrough = e.url), this.clickThrough(t, i)
        }, s.prototype.clickInstreamHandler = function() {
            this.instreamPlayer.getState() !== l && this.clickThrough(this.getVastAd(this.adPodIndex))
        }, s.prototype.clickThrough = function(e) {
            var t = !(1 < arguments.length && void 0 !== arguments[1]) || arguments[1];
            e.tracker.click();
            var i = {};
            e.clickthrough && (i.clickThroughUrl = e.clickthrough), this.reason = h, this.triggerEvent(a, i), window.jwcast && window.jwcast.player.id || e.clickthrough && t && window.open(e.clickthrough)
        }, s.prototype.skipVpaidAd = function() {
            this.endOfVpaidAdHandler(), this.vpaidAdSkipped()
        }, s.prototype.vpaidAdSkipped = function() {
            this.adSkipped(), this.endOfVpaidAdHandler()
        }, s.prototype.adSkipped = function() {
            clearTimeout(this.viewableTimeout);
            var e = this.getVastAd(this.adPodIndex);
            e.tracker.skip();
            var t = this.optionalParams.skipoffset;
            this.triggerEvent(be, {
                duration: e.duration,
                skipoffset: t,
                position: this.position,
                watchedPastSkipPoint: this.position - t
            })
        }, s.prototype.playbackErrorHandler = function(e) {
            var t = e.message || "Error Playing Ad Tag",
                i = e.code;
            i && 232404 === i ? i = 403 : (!i || i <= 4 || 901 < i) && (i = 405), this.vpaidPlayer && "function" == typeof this.vpaidPlayer.off ? (this.vpaidPlayer.off(), this.creativeAdError(t, i, e.adErrorCode)) : this.adError(t, i, e.adErrorCode)
        }, s.prototype.staticErrorHandler = function() {
            this.adError("Unable to fetch NonLinear resource", 502)
        }, s.prototype.vpaidExpandedHandler = function(e) {
            var t = this.getVastAd(this.adPodIndex).tracker;
            e.expanded ? t.expand() : t.collapse()
        }, s.prototype.triggerEvent = function(e, t) {
            var i = this.adEventObject(e);
            t && _e(i, t), this.trigger(e, i), -1 === v.indexOf(e) && this.player.trigger(e, i)
        }, s.prototype.addConditionalAdData = function(e) {
            this.vastAd && (e.conditionalAd = this.vastAd.conditionalAd), this.vastAdPod && this.vastAdPod.length && (e.conditionalAd = this.vastAdPod[this.adPodIndex].conditionalAd), e.conditionalAdOptOut = this.optionalParams.conditionaladoptout
        }, s
    }();

    function _(e, t) {
        "boolean" == typeof e.mediaFileCompliance && (t.mediaFileCompliance = e.mediaFileCompliance, e.nonComplianceReasons && (t.nonComplianceReasons = e.nonComplianceReasons))
    }

    function T(e, t) {
        t.request = e.request, t.response = e.response
    }

    function I(e) {
        return "application/javascript" === (t = e).type || "application/x-javascript" === t.type ? "html5" : "flash";
        var t
    }

    function C(e) {
        for (var t = void 0, i = 0; i < e.media.length; i++) {
            var r = e.media[i];
            if ("html5" === I(r)) {
                t = r;
                break
            }
        }
        return t
    }

    function S(e, t, i, r) {
        e.tracker = new b(e.trackers, t, i, r)
    }
    var Re = function() {
        function r(e, t, i) {
            y(this, r), this.debugTrackFn = e, this.div = null, this.elem = null, this.environment = t, this.utils = i
        }
        return r.prototype.addCompanion = function(e, t) {
            if (this.div = e, this.elem = document.getElementById(this.div.id), !this.elem) return !1;
            for (var i = 0; i < t.length; i++)
                if (this.fitsDiv(t[i])) return this.placeCompanion(t[i]), !0;
            return !1
        }, r.prototype.removeCompanion = function() {
            this.elem.innerHTML = ""
        }, r.prototype.sendPings = function(e) {
            (e = e.creativeView) && (e.forEach(function(e) {
                (new Image).src = e
            }), "function" == typeof this.debugTrackFn && this.debugTrackFn({
                type: "companion",
                data: {
                    trackers: e
                }
            }))
        }, r.prototype.placeCompanion = function(e) {
            var t = this;
            if (this.removeCompanion(), "html" === e.type) {
                var i = document.createElement("div");
                i.innerHTML = e.source;
                var r = i.getElementsByTagName("script");
                return r.length && Te._.map(r, function(e) {
                    new Te.utils.scriptloader(e.src).load(), e.parentElement.removeChild(e)
                }), this.elem.appendChild(i), void this.sendPings(e.trackers)
            }
            if ("iframe" === e.type) {
                var n = document.createElement("iframe");
                return n.height = this.div.height, n.width = this.div.width, n.src = e.source, n.scrolling = "no", n.style.border = "none", n.marginWidth = 0, n.marginHeight = 0, this.sendPings(e.trackers), this.elem.innerHTML = "", void this.elem.appendChild(n)
            }
            if ("application/x-shockwave-flash" === e.type) {
                var a = document.createElement("object");
                return a.setAttribute("type", "application/x-shockwave-flash"), a.setAttribute("data", e.source), a.setAttribute("width", "100%"), a.setAttribute("height", "100%"), a.setAttribute("tabindex", 0), R(a, "allowfullscreen", "true"), R(a, "allowscriptaccess", "always"), R(a, "seamlesstabbing", "true"), R(a, "wmode", "opaque"), this.elem.appendChild(a), void this.sendPings(e.trackers)
            }
            var s = new Image;
            s.src = e.source, Te.utils.exists(e.clickthrough) && (s.onclick = function() {
                t.utils.openLink(e.clickthrough, "_blank", {
                    rel: "noreferrer"
                })
            }), this.elem.innerHTML = "", this.elem.appendChild(s), this.sendPings(e.trackers)
        }, r.prototype.fitsDiv = function(e) {
            return e.width === this.div.width && e.height === this.div.height
        }, r
    }();

    function R(e, t, i) {
        var r = document.createElement("param");
        r.setAttribute("name", t), r.setAttribute("value", i), e.appendChild(r)
    }
    var xe = Date.now || function() {
        return (new Date).getTime()
    };

    function x(e, t, i) {
        var r = Ie(t, 1002, 11002);
        r.id = i, e.push(r)
    }

    function O() {
        var e = new Error("No AdBreaks in VMAP");
        throw e.adErrorCode = 60005, e
    }
    var M = function() {
        function t(e) {
            y(this, t), this._parsedAds = [], this._error = null, this._version = null, e && this.parse(e)
        }
        return t.prototype.parsedAds = function() {
            return this._parsedAds
        }, t.prototype.error = function() {
            return this._error
        }, t.prototype.version = function() {
            return this._version
        }, t.prototype.parse = function(i, r) {
            var n = this,
                e = void 0,
                a = void 0;
            "VAST" === i.nodeName ? e = i : (e = L(i, "VAST")[0]) || (e = L(i, "VideoAdServingTemplate")[0]), e || this.throwError(101, "Invalid VAST response"), a = "VideoAdServingTemplate" === e.tagName ? 1 : parseFloat(V(e, "version") || 0), this._version = a;
            var t, s = L(e, "Ad"),
                o = Te._.map(s, function(e) {
                    var t = n.parseAd(a, e);
                    return t.vastversion = a, t.response = i, t.request = r || null, t
                });
            this._parsedAds = o, this._parsedAds.length || (t = L(e, "Error"), Te._.each(t, function(e) {
                var t = H(e).replace(d, 303),
                    i = new Image;
                i.src = t
            }))
        }, t.prototype.parseAd = function(e, t, i) {
            i = i || {};
            var r, n, a, s, o = L(t, "InLine")[0],
                d = L(t, "Wrapper")[0],
                l = o || d,
                u = l ? H(L(l, "AdTitle")[0]) : "",
                p = void 0;
            return i.sequence = V(t, "sequence"), i.adTitle = u, (!e || 4.1 < e || e < 2) && this.throwError(102, "Vast version not supported"), 4 === e && (i.conditionalAd = !!V(t, "conditionalAd")), l ? (D(l, "Impression", (p = function(e) {
                var t = L(L(e, "Creatives")[0], "Creative"),
                    _ = {},
                    T = {
                        trackers: _
                    };
                T.adsystem = H(L(e, "AdSystem")[0]);
                var i = L(e, "Category");
                return T.categories = Te._.map(i, function(e) {
                    return H(e)
                }), Te._.each(t, function(e) {
                    var t = L(e, "Linear")[0],
                        i = L(e, "NonLinear")[0],
                        r = L(L(e, "TrackingEvents")[0], "Tracking"),
                        n = L(e, "UniversalAdId")[0],
                        a = V(n, "idRegistry") || "unknown",
                        s = H(n) || V(n, "idValue") || "unknown";
                    T.creativeId = V(e, "id"), t || i ? (Te._.each(r, function(e) {
                        B(_, e)
                    }), T.universalAdIdRegistry = a, T.universalAdIdValue = s) : (T.companionUniversalAdIdRegistry = a, T.companionUniversalAdIdValue = s);
                    var o, d, l, u, p, h, c, m, f, v, g = H(L(e, "AdParameters")[0]);
                    if (g && (T.adParams = g), t) {
                        var y = L(t, "VideoClicks")[0],
                            A = H(L(y, "ClickThrough")[0]),
                            P = L(y, "ClickTracking"),
                            k = V(t, "skipoffset"),
                            b = H(L(t, "Duration")[0]);
                        Te._.each(P, function(e) {
                            q(_, "click", H(e))
                        }), b && (T.duration = Te.utils.seconds(b)), A && (T.clickthrough = A), k && (T.skipoffset = k), m = T, f = L(L(t, "MediaFiles")[0], "MediaFile"), v = m.media ? m.media : [], m.media = v.concat(Te._.map(f, function(e) {
                            return {
                                type: V(e, "type"),
                                file: H(e),
                                adType: V(e, "apiFramework") || "",
                                width: parseInt(V(e, "width"), 10) || 0,
                                height: parseInt(V(e, "height"), 10) || 0
                            }
                        }).filter(function(e) {
                            return e.file
                        }))
                    } else if (i) {
                        var w = H(L(i, "NonLinearClickThrough")[0]);
                        w && (T.clickthrough = w), p = T, h = [], (c = L(u = e, "StaticResource")[0]) && (h.push({
                            type: V(c, "creativeType"),
                            file: H(c),
                            adType: V(L(u, "NonLinear")[0], "apiFramework") || "static",
                            minDuration: V(L(u, "NonLinear")[0], "minSuggestedDuration") || "00:00:00"
                        }), p.media = h)
                    } else o = T, d = L(L(e, "CompanionAds")[0], "Companion"), l = o.companions ? o.companions : [], Te._.each(d, function(e) {
                        var t = L(e, "StaticResource")[0],
                            i = L(e, "IFrameResource")[0],
                            r = L(e, "HTMLResource")[0],
                            n = {},
                            a = void 0,
                            s = void 0;
                        if (t) a = V(t, "creativeType"), s = H(t);
                        else if (i) a = "iframe", s = H(i);
                        else {
                            if (!r) return;
                            a = "html", s = H(r)
                        }
                        var o = L(L(e, "TrackingEvents")[0], "Tracking");
                        Te._.each(o, function(e) {
                            var t = V(e, "event");
                            q(n, t, H(e))
                        });
                        var d = H(L(e, "CompanionClickThrough")[0]);
                        l.push({
                            width: parseInt(V(e, "width"), 10),
                            height: parseInt(V(e, "height"), 10),
                            type: a,
                            source: s,
                            trackers: n,
                            clickthrough: d
                        })
                    }), o.companions = l
                }), T
            }(l)).trackers), D(l, "Error", p.trackers), a = p, s = {}, Te._.each(a.media, function(e) {
                var t = e.type,
                    i = "application/x-mpegURL" === t || "vnd.apple.mpegURL" === t;
                "vpaid" === e.adType.toLowerCase() || i || (s[t] = s[t] || 0, s[t]++)
            }), a.mediaFileCompliance = !0, Te._.each(s, function(e, t) {
                e < 3 && (a.mediaFileCompliance = !1, a.nonComplianceReasons = a.nonComplianceReasons || [], a.nonComplianceReasons.push(t + " has only " + e + " qualities"))
            }), d && (p.wrappedURI = H(L(d, "VASTAdTagURI")[0]) || H(L(d, "VASTAdTagURL")[0]), p.followAdditionalWrappers = JSON.parse(V(d, "followAdditionalWrappers")), p.allowMultipleAds = JSON.parse(V(d, "allowMultipleAds")), p.fallbackOnNoAd = JSON.parse(V(d, "fallbackOnNoAd"))), r = p, n = _e({}, i), Te.utils.foreach(r, function(e, t) {
                Te.utils.exists(n[e]) ? Array.isArray(t) ? n[e] = n[e].concat(t) : "object" === Te.utils.typeOf(t) ? n[e] = _e(n[e], r[e]) : n[e] = t : n[e] = t
            }), p = n) : this.throwError(303, "No ads", 10303), p
        }, t.prototype.throwError = function(e, t, i) {
            var r = this,
                n = Ie(t, e, i = i || 1e4 + e);
            throw n.toString = function() {
                return r.code + " " + r.message
            }, this._error = n, this._error
        }, t
    }();

    function L(e, t, i) {
        var r = [];
        return e && (r = e.getElementsByTagName(t), i && r && 0 === r.length && (r = e.getElementsByTagName(i + ":" + t))), r
    }

    function V(e, t) {
        return e ? e.getAttribute(t) : null
    }

    function B(e, t) {
        var i = V(t, "event");
        "progress" === i && (i = i + "_" + V(t, "offset"));
        q(e, i, H(t))
    }

    function H(e) {
        if (e) {
            var t = e.textContent || e.text;
            if (t) return Te.utils.trim(t)
        }
        return ""
    }

    function q(e, t, i) {
        e[t] || (e[t] = []), i && e[t].push(i)
    }

    function D(e, t, i) {
        var r = L(e, t);
        Te._.each(r, function(e) {
            q(i, t.toLowerCase(), H(e))
        })
    }

    function j(e) {
        e.onload = e.onreadystatechange = e.onerror = null, "abort" in e && e.abort()
    }
    var Oe = function() {
        function t(e) {
            y(this, t), this.preRoll = null, this.vmap = null, this.postRoll = null, this.midRolls = [], this.playedMidRolls = [], this.adRules = e, this.duration = 0, this._vmapPromise = null, this._vmapXHR = null
        }
        return t.prototype.load = function(a, s) {
            var o = this;
            return this._vmapPromise || (null !== this._vmapXHR && (j(this._vmapXHR), this._vmapXHR = null), this._vmapPromise = new Promise(function(e, n) {
                o._vmapXHR = a.utils.ajax({
                    url: s,
                    withCredentials: !0,
                    retryWithoutCredentials: !0,
                    requireValidXML: !0,
                    timeout: o.requestTimeout
                }, e, function(e, t, i, r) {
                    return n(r)
                })
            }).then(function(e) {
                return o._vmapXHR = null,
                    function(e, t) {
                        var i = [],
                            r = L(e, "VMAP", E);
                        if (!r.length) throw new Error("No VMAP tag in response");
                        V(r[0], "version") || x(i, "VMAP Schema Error: version missing from VMAP tag", ie);
                        var n = L(e, "AdBreak", E);
                        n.length || O();
                        for (var a = e.lookupNamespaceURI(E), s = 0; s < n.length; s++) {
                            var o = {},
                                d = {},
                                l = n[s],
                                u = V(l, "timeOffset"),
                                p = V(l, "breakId"),
                                h = V(l, "breakType"),
                                c = V(L(l, "AdSource", E)[0], "id"),
                                m = L(l, "AdTagURI", E)[0],
                                f = L(l, "VASTData", E)[0] || L(l, "VASTAdData", E)[0],
                                v = V(m, "templateType"),
                                g = H(m),
                                y = (w = l, _ = "Tracking", T = E, I = void 0, I = [], (b = a) || w ? I = w.getElementsByTagNameNS ? w.getElementsByTagNameNS(b, _) : w.getElementsByTagName(T + ":" + _) : I);
                            if (h || x(i, "VMAP Schema Error: missing breakType on AdBreak", p), f || v || x(i, "VMAP Schema Error: missing templateType on AdBreak", p), u || x(i, "VMAP Schema Error: missing timeOffset on AdBreak", p), o._type = h, o._vmap = {
                                    id: c,
                                    breakid: p,
                                    timeoffset: u
                                }, f) o._adXML = L(f, "VAST")[0];
                            else {
                                if ("vast2" !== v && "vast3" !== v && "vast4" !== v) continue;
                                o._adQueue = [g], o._waterfallIndex = 0
                            }
                            var A = [];
                            if (y)
                                for (var P = 0; P < y.length; P++) {
                                    B(d, y[P]);
                                    var k = V(y[P], "event");
                                    A.push(k)
                                }
                            switch ((A.indexOf("breakStart") < 0 || A.indexOf("breakEnd") < 0 || A.indexOf("error") < 0) && x(i, "Tracking events are missing breakStart, breakEnd, or error for AdBreak", p), o._trackers = d, o._type = h, u) {
                                case "start":
                                    o._offSet = "pre", t.setPreRoll(o);
                                    break;
                                case "100%":
                                case "end":
                                    o._offSet = "post", t.setPostRoll(o);
                                    break;
                                default:
                                    if (/^#/.test(u)) break;
                                    /^\d\d?(?:\.\d+)?%$/.test(u) ? o._offSet = u : o._offSet = Te.utils.seconds(u), t.addMidRoll(o)
                            }
                        }
                        var b, w, _, T, I;
                        return t.preRoll || t.midRolls.length || t.postRoll || O(), t.sort(null, !0), i
                    }(e.responseXML, o).map(function(e) {
                        return e.vmap = s, e
                    })
            }).catch(function(e) {
                o._vmapXHR = null;
                var t = void 0;
                if (e.message) t = Ie("VMAP Schema Error: " + e.message, 1002, e.adErrorCode || 11002);
                else {
                    var i = {
                            1: {
                                code: 1007,
                                message: "Timeout"
                            },
                            602: {
                                code: 1e3,
                                message: "Invalid XML"
                            },
                            default: {
                                code: 1008,
                                message: a.getConfig().localization.errors[e.key]
                            }
                        },
                        r = i[e.code] || i.default;
                    a.utils.log(r.message), t = Ie("Error Loading VMAP Schedule", r.code, r.code + 1e4)
                }
                throw t.id = ie, t.vmap = s, t
            })), this._vmapPromise
        }, t.prototype.canWaterfall = function(e) {
            return e._adQueue && e._waterfallIndex + 1 < e._adQueue.length
        }, t.prototype.setPreRoll = function(e) {
            this.preRoll = e
        }, t.prototype.getPreRoll = function(e) {
            return e && "none" === this.adRules.startOnSeek ? null : N(this.preRoll, this.requestTimeout, this.creativeTimeout)
        }, t.prototype.getPostRoll = function(e) {
            var t = N(this.postRoll, this.requestTimeout, this.creativeTimeout);
            return this.adRules.timeBetweenAdsAllowsAdPlayback(t, e) ? t : null
        }, t.prototype.getMidRollAtIndex = function(e) {
            return N(this.midRolls[e], this.requestTimeout, this.creativeTimeout)
        }, t.prototype.getLastMidRollIndexBetweenTime = function(e, t, i) {
            if (t < e) return null;
            this.sort(i);
            for (var r = this.midRolls.length; r--;) {
                var n = this.midRolls[r],
                    a = F(this.midRolls[r]._offSet, i);
                if (a <= e) return null;
                if (a <= t) {
                    var s = N(n, this.requestTimeout, this.creativeTimeout);
                    if (!this.adRules.timeBetweenAdsAllowsAdPlayback(s)) return null;
                    if (!this.adRules.timeBetweenAds) {
                        if (0 <= this.playedMidRolls.indexOf(r)) return null;
                        this.playedMidRolls.push(r)
                    }
                    return r
                }
            }
            return null
        }, t.prototype.peek = function(e, t, i) {
            if (this.midRolls.length > this.playedMidRolls.length) {
                this.sort(i);
                for (var r = 0; this.midRolls[r];) {
                    var n = F(this.midRolls[r]._offSet, i);
                    if (e <= n && -1 === this.playedMidRolls.indexOf(r)) {
                        var a = xe() + 1e3 * (n - e);
                        return n <= t && this.adRules.timeBetweenAdsAllowsAdPlayback(null, a) ? r : null
                    }
                    r += 1
                }
            }
            var s = xe() + 1e3 * (i - e);
            return this.postRoll && i <= t && this.adRules.timeBetweenAdsAllowsAdPlayback(null, s) ? -1 : null
        }, t.prototype.getNextMidrollIndex = function(e, t, i) {
            if (this.adRules.timeBetweenAds || this.adRules.startOnSeek) return this.getLastMidRollIndexBetweenTime(e, t, i);
            if (this.midRolls.length > this.playedMidRolls.length) {
                var r = this.getClosestIndex(t, i);
                if (0 <= r && this.playedMidRolls.indexOf(r) < 0) return this.playedMidRolls.push(r), r
            }
            return null
        }, t.prototype.getMidRolls = function() {
            var t = this;
            return this.midRolls.map(function(e) {
                return N(e, t.requestTimeout, t.creativeTimeout)
            })
        }, t.prototype.reset = function() {
            null !== this._vmapXHR && (j(this._vmapXHR), this._vmapXHR = null), this.playedMidRolls = [], this.duration = 0
        }, t.prototype.addMidRoll = function(e) {
            this.midRolls.push(e), this.duration = 0
        }, t.prototype.setPostRoll = function(e) {
            this.postRoll = e
        }, t.prototype.sort = function(i, e) {
            (!i || i < 1) && (i = 1), (this.duration !== i || e) && (this.duration = i, this.midRolls.sort(function(e, t) {
                return F(e._offSet, i) - F(t._offSet, i)
            }), function(e, t) {
                for (var i = 0; i < e.length; i++) {
                    var r = e[i];
                    t ? r._vmap.item = i + 1 : r._adbreak = {
                        item: i + 1,
                        tags: r._adQueue,
                        breakid: r._breakId
                    }
                }
            }(this.getAllAds(), e))
        }, t.prototype.getAllAds = function() {
            var e = this.preRoll ? [this.preRoll] : [],
                t = this.postRoll ? [this.postRoll] : [];
            return e.concat(this.midRolls, t)
        }, t.prototype.getAdScheduleEventObject = function() {
            var e = this.getAllAds(),
                r = [],
                t = {
                    tag: this.getVMAP(),
                    client: "vast",
                    adbreaks: []
                };
            return Te.utils.foreach(e, function(e, t) {
                var i = {
                    type: t._type,
                    offset: t._offSet
                };
                t._vmap ? i.vmap = t._vmap : i.adbreak = _e({}, t._adbreak), r.push(i)
            }), t.adbreaks = r, t
        }, t.prototype.setVMAP = function(e) {
            this.vmap = e
        }, t.prototype.isVMAP = function() {
            return !!this.vmap
        }, t.prototype.getVMAP = function() {
            return this.vmap
        }, t.prototype.getClosestIndex = function(e, t) {
            this.sort(t);
            for (var i = this.midRolls.length; i--;)
                if (e >= F(this.midRolls[i]._offSet, t)) return i;
            return -1
        }, t
    }();

    function N(e, t, i) {
        var r = void 0;
        if (Te.utils.foreach(e, function(e, t) {
                (r = r || {})[e] = "_adQueue" === e ? t.slice() : t
            }), r) return r.requestTimeout = t, r.creativeTimeout = i, r._errors = [], r._waterfallIndex = 0, r
    }

    function F(e, t) {
        return "%" === e.toString().slice(-1) ? t * parseFloat(e.slice(0, -1)) / 100 : parseFloat(e)
    }
    var Me = function() {
        function e() {
            y(this, e)
        }
        return e.prototype.getSchedule = function(e, t) {
            var i = new Oe(t);
            if (i.requestTimeout = X(e.requestTimeout, re), i.creativeTimeout = X(e.creativeTimeout, ne), e.tag) i.setPreRoll({
                _offSet: "pre",
                _adQueue: U(e.tag),
                _waterfallIndex: 0
            });
            else if ("string" == typeof e.vastxml) i.setPreRoll({
                _offSet: "pre",
                _adXML: e.vastxml
            });
            else {
                if ("string" == typeof e.schedule) return i.setVMAP(e.schedule), i;
                if ("string" == typeof e.adschedule) return i.setVMAP(e.adschedule), i;
                ! function(d, l) {
                    var u = l.schedule || l.adschedule;
                    if (!u) return;
                    Object.keys(u).forEach(function(e) {
                        var t = u[e];
                        t.ad && (_e(t, t.ad), delete t.ad);
                        var i = function(e) {
                                if ("start" === e || "0%" === e || !e && 0 !== e) return "pre";
                                if ("end" === e || "100%" === e) return "post";
                                if ("pre" === e || "post" === e || -1 < Te._.indexOf(e, "%")) return e;
                                var t = Te.utils.seconds(e);
                                if ("number" == typeof t) return t;
                                return !1
                            }(t.offset),
                            r = X(t.requestTimeout, re),
                            n = X(t.creativeTimeout, ne),
                            a = {
                                _offSet: i,
                                _type: t.type,
                                _breakId: e,
                                requestTimeout: r,
                                creativeTimeout: n
                            };
                        !1 === i && Te.utils.log("Error: ad offset format not supported", i);
                        var s = t.skipoffset || l.skipoffset;
                        if (void 0 !== s && (a.skipoffset = s), t.tag) {
                            var o = function(e, t) {
                                if (!t) return e;
                                var i = 0 <= e.indexOf("?") ? "&" : "?",
                                    r = "cust_params=",
                                    n = e.indexOf(r),
                                    a = r.length,
                                    s = "",
                                    o = "";
                                if (Te.utils.foreach(t, function(e, t) {
                                        s = "" + s + o + e + "=" + t, o = "&"
                                    }), s = encodeURIComponent(s), 0 <= n) {
                                    var d = e.substr(0, n + a),
                                        l = e.substr(n + a);
                                    return "" + d + s + "%26" + l
                                }
                                return "" + e + i + "cust_params=" + s
                            }(t.tag, t.custParams);
                            a._adQueue = U(o), a._waterfallIndex = 0
                        } else {
                            if ("string" != typeof t.vastxml) return void Te.utils.log("Error: no ad tag provided");
                            a._adXML = t.vastxml
                        }
                        switch (i) {
                            case "pre":
                                d.setPreRoll(a);
                                break;
                            case "post":
                                d.setPostRoll(a);
                                break;
                            default:
                                d.addMidRoll(a)
                        }
                    })
                }(i, e)
            }
            return i.sort(), i
        }, e.prototype.getOptParams = function(e, t) {
            var i = {
                    cuetext: t.cuetext,
                    dynamicMessage: t.admessage,
                    loadingAd: t.loadingAd,
                    podMessage: t.podmessage,
                    skipoffset: e.skipoffset || -1,
                    skipMessage: t.skipmessage,
                    skipText: t.skiptext,
                    vpaidcontrols: e.vpaidcontrols || !1,
                    conditionaladoptout: e.conditionaladoptout || !1,
                    requestFilter: e.requestFilter,
                    trackingFilter: e.trackingFilter
                },
                r = e.companiondiv;
            return r && (i.companion = {
                id: r.id,
                height: r.height,
                width: r.width
            }), i
        }, e.prototype.getAdRules = function(e) {
            var t = e.rules || {},
                i = parseInt(t.frequency, 10);
            return {
                startOn: t.startOn || 1,
                frequency: isNaN(i) ? 1 : i,
                timeBetweenAds: t.timeBetweenAds || 0,
                startOnSeek: t.startOnSeek || null
            }
        }, e
    }();

    function U(e) {
        return "string" == typeof e ? [e] : Array.isArray(e) ? e.slice(0) : e
    }

    function X(e, t) {
        return 0 === e ? 1 / 0 : e || t
    }
    var W = /^((https?:)?\/\/)?(secure)?pubads\.g\.doubleclick\.net\/gampad\/ads\?[\S]*$/;

    function Le(e, t, i) {
        if (!e) return e;
        var r, n, a, s, o, d, l = (n = (r = t).getConfig(), {
                playerHeight: r.getHeight() || n.height || "",
                playerWidth: r.getWidth() || n.width || "",
                itemDuration: (a = r.getDuration(), s = 3, o = Math.pow(10, s), Math.round(a * o) / o || ""),
                item: n.playlist[r.getPlaylistIndex()] || {}
            }),
            u = l.item,
            p = window.location.href;
        e = Q(e = Q(e = Q(e = Q(e = Q(e = Q(e = Q(e = Q(e, "__random-number__", Math.random() * Math.pow(10, 18)), "__timestamp__", (new Date).getTime()), "__page-url__", encodeURIComponent(p)), "__referrer__", encodeURIComponent(document.referrer)), "__player-height__", l.playerHeight), "__player-width__", l.playerWidth), "__item-duration__", l.itemDuration), "__domain__", encodeURIComponent((d = (d = window.location.href).match(new RegExp(/^[^/]*:\/\/\/?([^\/]*)/))) && 1 < d.length ? d[1] : ""));
        for (var h = (e = i.companion ? Q(e, "__companion-div__", i.companion.id) : Q(e, "__companion-div__", "")).match(new RegExp(/__item-[a-z 0-9 A-Z]*__/g)), c = 0; h && c < h.length; c++) {
            var m = h[c],
                f = m.substring(7, m.length - 2);
            if (u.hasOwnProperty(f) && "string" == typeof u[f]) {
                var v = u[f];
                1e3 < v.length && (v = v.substring(0, 1e3)), e = Q(e, m, encodeURIComponent(v))
            } else e = Q(e, m, "")
        }
        return e = function(e, t, i) {
            W.test(e) && (e = e + "&vpa=" + t + "&vpmute=" + i);
            return e
        }(e, t.getConfig().autostart ? 1 : 0, t.getMute() ? 1 : 0)
    }

    function Q(e, t, i) {
        return e.replace(t, i)
    }
    var z, $, J, K = function() {
        function a(e, t, i, r, n) {
            y(this, a), this._scheduledAd = e, this.player = t, this.options = i || {}, this.wrapperOptions = r || {
                followAdditionalAds: !0,
                allowMultipleAds: !0
            }, this.debugTrackFn = n, _e(this, t.Events), this._history = [], this.loadedAds = [], this.parser = null, this.promise = null, this.xmlhttp = null
        }
        return a.prototype.load = function(t) {
            var i = this;
            if (null === this.promise) {
                this._history.push(t);
                var r = this.options.requestFilter;
                this.promise = new Promise(function(e, n) {
                    i.xmlhttp = Te.utils.ajax({
                        url: t,
                        withCredentials: !0,
                        retryWithoutCredentials: !0,
                        requireValidXML: !0,
                        timeout: i._scheduledAd.requestTimeout,
                        requestFilter: r
                    }, e, function(e, t, i, r) {
                        return n(r)
                    })
                }).catch(function(e) {
                    if (null !== i.player) throw i.ajaxError(e, t)
                }).then(function(e) {
                    if (null !== i.player) return i.parseXMLString(e.responseXML || e.responseText, t)
                })
            }
            return this.promise
        }, a.prototype.destroy = function() {
            var e;
            (e = this.xmlhttp) && (e.onload = null, e.onreadystatechange = null, e.onerror = null, e.abort && e.abort()), this.player = null, this.xmlhttp = null
        }, a.prototype.scheduledAd = function() {
            return this._scheduledAd
        }, a.prototype.allAds = function() {
            return this.loadedAds
        }, a.prototype.adPod = function() {
            var t = [];
            return this.loadedAds.forEach(function(e) {
                e.sequence && t.push(e)
            }), t.sort(function(e, t) {
                return e.sequence - t.sequence
            }), t
        }, a.prototype.adBuffet = function() {
            var t = [];
            return this.loadedAds.forEach(function(e) {
                e.sequence || t.push(e)
            }), t
        }, a.prototype.history = function() {
            return this._history
        }, a.prototype.parseXMLString = function(i, r) {
            var o = this;
            return null === this.parser && (this.parser = new M), new Promise(function(e) {
                var t = function(e) {
                    if (t = e, "object" == typeof Node ? t instanceof Node : t && "object" == typeof t && "number" == typeof t.nodeType && "string" == typeof t.nodeName) return e;
                    var t;
                    return Te.utils.parseXML(e)
                }(i);
                if (null === t) {
                    throw {
                        message: "Invalid XML",
                        code: 100
                    }
                }
                return o.parser.parse(t, o.xmlhttp), e(o.parser.parsedAds())
            }).catch(function(e) {
                if (null !== o.player) {
                    var t = e.code || 900,
                        i = e.adErrorCode || 1e4 + t;
                    throw o.sendErrorEvent(e.message, t, i, r)
                }
            }).then(function(e) {
                if (null === o.player) return null;
                if (0 === e.length) throw o.sendErrorEvent("No ads", 303, 10303, r);
                var n = e.filter(function(e) {
                    return !e.sequence
                });
                o.wrapperOptions.allowMultipleAds ? o.loadedAds = e : o.loadedAds = n, o.options.wrapper = o.options.wrapper || [], o.options.adsystem && o.options.wrapper.push(o.options.adsystem), o.options.adsystem = o.loadedAds[0].adsystem;
                var t = [];
                return e.forEach(function(s) {
                    if (s.wrappedURI) {
                        if (!1 === o.wrapperOptions.followAdditionalWrappers) return;
                        o.options.wrappedTags = o.options.wrappedTags || [o._scheduledAd._currentTag], o.options.wrappedTags.push(s.wrappedURI);
                        var e = new a(o._scheduledAd, o.player, o.options, {
                            fallbackOnNoAd: s.fallbackOnNoAd,
                            allowMultipleAds: s.allowMultipleAds,
                            followAdditionalWrappers: s.followAdditionalWrappers
                        }, o.debugTrackFn).load(s.wrappedURI).then(function(e) {
                            var n, t, a, i = (n = s, t = e.allAds(), a = [], Te.utils.foreach(t, function(e, t) {
                                    var i, r;
                                    n.companions && (t.companions = (t.companions ? t.companions : []).concat(n.companions)), n.trackers && (t.trackers = (i = t.trackers, r = n.trackers, i = i || {}, Te.utils.foreach(r, function(e, t) {
                                        i[e] ? i[e] = i[e].concat(t) : i[e] = t
                                    }), i)), n.sequence && (t.sequence = n.sequence), a.push(t)
                                }), a),
                                r = o.loadedAds.indexOf(s);
                            Array.prototype.splice.apply(o.loadedAds, [r, 1].concat(i))
                        }).catch(function(e) {
                            var t = o.sendAdpodErrorEvent(e.message, e.code, e.adErrorCode, e.url),
                                i = s.fallbackOnNoAd && s.sequence && n.length && "Ad Tag Empty" === t.message,
                                r = o.loadedAds.indexOf(s);
                            if (i) return s.loadError = t, void e.vloader.destroy();
                            if (o.loadedAds.splice(r, 1), e.vloader.destroy(), t.type !== pe) throw t;
                            o.trigger(pe, t)
                        });
                        t.push(e)
                    } else 1 < o.options.wrapper.length && (s.wrapper = o.options.wrapper, s.wrappedTags = o.options.wrappedTags)
                }), Promise.all(t)
            }).then(function() {
                if (null === o.player) return null;
                var n = o.loadedAds.filter(function(e) {
                    return !e.sequence
                });
                o.loadedAds.forEach(function(e, t) {
                    if (e.loadError)
                        if (n.length) {
                            var i = o.loadedAds[t + 1],
                                r = i && !i.sequence ? i : n[0];
                            o.loadedAds[t] = _e({}, r, {
                                sequence: e.sequence
                            })
                        } else o.trigger(pe, e.loadError)
                });
                var t = o.loadedAds.slice(0),
                    e = t.length;
                t.forEach(function(e) {
                    e.media && e.media.length || t.length--
                });
                var i = 0 === e,
                    r = t.length !== e;
                if (i || r) throw o.sendErrorEvent("Ad Tag Empty", 101, 10101, o._history[o._history.length - 1]);
                return o
            })
        }, a.prototype.ajaxError = function(e, t) {
            if (this.player.getAdBlock()) return this.sendErrorEvent("Ad playback blocked by an ad blocker", 900, 60003, t);
            var i = e.code;
            if (601 === i || 602 === i) return this.sendErrorEvent("Invalid XML", 100, 10100, t);
            var r = this.options.wrappedTags && this.options.wrappedTags.length,
                n = r ? 301 : 900,
                a = r ? 10301 : 60006;
            return this.sendErrorEvent(e.message || "Error loading file", n, a, t)
        }, a.prototype.firstUrl = function() {
            return this._history && this._history.length ? this._history[0] : ""
        }, a.prototype.sendAdpodErrorEvent = function(e, t, i, r) {
            if (1 === this.loadedAds.length) return this.sendErrorEvent(e, t, i, r);
            var n = Ie(e, t, i);
            return n.type = pe, n.vloader = this, n.url = this.firstUrl() || r, this.wrappedTags = r, n
        }, a.prototype.sendErrorEvent = function(e, t, i, r) {
            var n = Ie(e, t, i);
            return n.vloader = this, n.url = this.firstUrl() || r, this.options.wrappedTags && (n.wrapperAdSystem = this.options.wrapper || "", n.wrappedTags = this.options.wrappedTags), n.adsystem = this.options.adsystem || "", this.trackError(n), n
        }, a.prototype.trackError = function(e) {
            var t = e.vloader.allAds();
            if (t && t.length) {
                var i = t[0];
                if (i) {
                    var r = i.trackers;
                    if (r && r.error) new b(r, this.debugTrackFn, this.player, this.options.trackingFilter).error(e.code)
                }
            }
        }, a
    }();
    var G = 2e3,
        Y = 3500,
        Z = "usd",
        ee = 1,
        Ve = "//c.amazon-adsystem.com/aax2/apstag.js",
        Be = "video",
        He = "3.0.0",
        qe = "//js-sec.indexww.com/htv/htv-jwplayer.min.js",
        De = "//js.spotx.tv/directsdk/v1/",
        je = "//search.spotxchange.com/ad/vast.html?key=",
        Ne = "dfp",
        Fe = "jwp",
        Ue = "jwpspotx",
        Xe = "jwpdfp",
        We = Fe,
        Qe = "APS",
        ze = "Index",
        $e = "OpenRTB",
        Je = "SpotX",
        Ke = ((z = {})[[Ne]] = [Qe, "FAN", ze, $e, Je], z[[Fe]] = ["FAN", $e, Je], z[[Xe]] = [$e, Je], z[[Ue]] = [Je], z),
        Ge = "Error loading script",
        Ye = (($ = {})[["EMX"]] = {
            endpoint: "https://hbint.emxdgt.com"
        }, $[["PubMatic"]] = {
            endpoint: "https://openbid.pubmatic.com/translator"
        }, $[["Telaria"]] = {
            endpoint: "https://jwplayer.eb.tremorhub.com/ad/rtb/jwp",
            preflight: !0
        }, $),
        Ze = 1,
        et = 2,
        tt = 1,
        it = 2,
        rt = 3,
        nt = 4,
        at = 5,
        st = 6,
        ot = 7,
        dt = 8,
        lt = 1,
        ut = 2,
        pt = 3,
        ht = 4,
        ct = 5,
        mt = 6,
        ft = {
            BID_WON: 0,
            BID_BELOW_AUCTION_FLOOR: 100,
            LOST_TO_HIGHER_BID: 102
        },
        vt = "abort",
        gt = "bid",
        yt = "error",
        At = "invalid",
        Pt = "noBid",
        kt = "timeout",
        bt = ((J = {})[[Pt]] = 0, J[[gt]] = 1, J[[kt]] = 2, J[[At]] = 3, J[[vt]] = 4, J[[yt]] = 5, J),
        wt = 550,
        _t = 599,
        Tt = {
            0: 500,
            400: 501,
            500: 503,
            597: 502
        },
        It = [{
            message: "SpotX :: Unable to find ad",
            result: Pt,
            code: bt[Pt]
        }, {
            message: Ge,
            result: yt,
            code: 6
        }, {
            message: "Invalid options: 'slot' is required",
            code: 300
        }, {
            message: "Invalid options: 'slot' must be part of DOM",
            code: 301
        }, {
            message: "Invalid options: 'channel_id' is required.",
            code: 302
        }, {
            message: "Invalid options: 'content_width' and 'content_height' are required when no 'video_slot' is provided.",
            code: 303
        }, {
            message: "Invalid options: 'content_width' provided but 'content_height' is not.",
            code: 304
        }, {
            message: "Invalid options: 'content_height' provided but 'content_width' is not.",
            code: 305
        }, {
            message: "Invalid options: 'custom' must be an object.",
            code: 306
        }, {
            message: "Invalid options: 'token' must be an object.",
            code: 307
        }, {
            message: "Invalid options: 'ados' must be an object.",
            code: 308
        }, {
            message: "Invalid options: 'contentPageUrl' must be a string.",
            code: 309
        }, {
            message: "Invalid options: 'demand_source_timeout' must be a number.",
            code: 310
        }, {
            message: "Invalid options: 'total_bid_timeout' must be a number.",
            code: 311
        }],
        Et = 320,
        Ct = [{
            message: "Incorrect domain",
            code: 321
        }, {
            message: "unsupported_platform",
            code: 322
        }, {
            message: "Request_URL_noncompliant",
            code: 323
        }, {
            message: "Application not authorised for header bidding",
            code: 324
        }, {
            message: "pageurl is required",
            code: 325
        }, {
            message: "adformats",
            code: 326
        }],
        St = Date.now || function() {
            return (new Date).getTime()
        };

    function Rt(e, t, i) {
        var r = 3 < arguments.length && void 0 !== arguments[3] ? arguments[3] : {},
            n = e.createElement(t);
        return n.appendChild(e.createCDATASection(i)), Object.keys(r).forEach(function(e) {
            n.setAttribute(e, r[e])
        }), n
    }

    function xt(e) {
        return e ? 3 : 1
    }

    function Ot(e) {
        if ("start" === e || "0%" === e || !e || "pre" === e || "00:00:00" === e) return 0;
        if ("end" === e || "100%" === e || "post" === e) return -2;
        if ("string" == typeof e && 0 <= e.indexOf("%")) return -1;
        var t = parseInt(e);
        return 0 <= t ? t : -1
    }

    function Mt(n, a) {
        return new Promise(function(t, e) {
            setTimeout(e, a);
            var i = document.createElement("script");
            i.onload = i.onreadystatechange = function(e) {
                this.readyState && "loaded" !== this.readyState && "complete" !== this.readyState || (t(e), i.onload = i.onreadystatechange = null, r && i.parentNode && r.removeChild(i))
            }, i.onerror = e, i.type = "text/javascript", i.charset = "utf-8", i.async = !0, i.timeout = a, i.src = n;
            var r = document.getElementsByTagName("head")[0] || document.documentElement;
            r.insertBefore(i, r.firstChild)
        }).catch(function() {
            return Promise.reject({
                message: Ge
            })
        })
    }

    function Lt(e) {
        return e.outerHTML || (new XMLSerializer).serializeToString(e)
    }
    var Vt = window.__cmp || function(e, t, i) {
            for (var r = null, n = window; n !== window.top;) {
                try {
                    if (n.frames.__cmpLocator) {
                        r = n;
                        break
                    }
                } catch (e) {}
                n = n.parent
            }
            if (r) {
                var a = St(),
                    s = function(e) {
                        var t = e ? e.data : {};
                        if ("string" == typeof t) try {
                            t = JSON.parse(t)
                        } catch (e) {
                            t = {}
                        }
                        t.__cmpReturn && t.__cmpReturn.callId === a && (removeEventListener("message", s), i(t.__cmpReturn.returnValue))
                    };
                window.addEventListener("message", s, !1);
                var o = {
                    __cmpCall: {
                        command: e,
                        parameter: t,
                        callId: a
                    }
                };
                r.postMessage(JSON.stringify(o), "*")
            } else i({
                gdprApplies: !1
            })
        },
        Bt = function(e, t) {
            return e.replace(/\$\{AUCTION_ID\}/g, t.id).replace(/\$\{AUCTION_BID_ID\}/g, t.bid || "").replace(/\$\{AUCTION_IMP_ID\}/g, t.imp).replace(/\$\{AUCTION_SEAT_ID\}/g, t.seat || "").replace(/\$\{AUCTION_AD_ID\}/g, t.ad || "").replace(/\$\{AUCTION_CURRENCY\}/g, t.cur)
        },
        Ht = function(e, t, i) {
            var r = i ? i.priceInCents : "",
                n = t.priceInCents ? r / t.priceInCents : "",
                a = ft[i ? "LOST_TO_HIGHER_BID" : "BID_BELOW_AUCTION_FLOOR"];
            return e.replace(/\$\{AUCTION_PRICE\}/g, r / 100).replace(/\$\{AUCTION_MBR\}/g, n).replace(/\$\{AUCTION_LOSS\}/g, t.winner ? ft.BID_WON : a)
        },
        qt = {
            postAuctionHandler: function(e, t) {
                if ((!t || t.winner) && e.result === gt) {
                    e.adm && (e.adm = Ht(e.adm, e, t));
                    var i = e.winner ? e.custom.nurl : e.custom.lurl;
                    if (i)
                        if (e.winner && !e.adm) e.tag = Ht(i, e, t);
                        else {
                            var r = new XMLHttpRequest;
                            r.open("POST", Ht(i, e, t));
                            var n = Ye[e.name];
                            n && n.preflight && r.setRequestHeader("x-openrtb-version", "2.5"), r.withCredentials = !0, r.send(null)
                        }
                }
                return delete e.custom, e
            },
            requestBids: function(h, c, i, m) {
                var r = Ye[h.name];
                if (!r || !h.id || !h.pubid) return Promise.resolve({
                    result: At
                });
                var e, t, f = c.floorPriceCurrency || Z,
                    n = void 0 !== c.skipoffset,
                    v = {
                        id: c.adPlayId,
                        imp: [{
                            id: "1",
                            displaymanager: "jwplayer",
                            tagid: h.id,
                            video: {
                                mimes: (e = ["video/mp4", "video/ogg", "video/webm", "video/aac", "application/vnd.apple.mpegurl"], t = document.createElement("video"), e.filter(function(e) {
                                    return t.canPlayType(e)
                                })).concat("application/javascript"),
                                minduration: 3,
                                maxduration: 300,
                                protocols: [tt, it, rt, ot, nt, at, st, dt],
                                w: c.playerWidth,
                                h: c.playerHeight,
                                startdelay: Ot(c.offset),
                                placement: xt(c),
                                linearity: 1,
                                skip: n ? 1 : 0,
                                skipmin: n ? c.skipoffset + 2 : void 0,
                                skipafter: c.skipoffset,
                                playbackmethod: [function(e) {
                                    var t = e.autoplay,
                                        i = e.mute,
                                        r = e.autoplayAdsMuted;
                                    if (t) {
                                        var n = i || r;
                                        return "viewable" === t ? n ? mt : ct : n ? ut : lt
                                    }
                                    return i ? ht : pt
                                }(c)],
                                api: [Ze, et]
                            },
                            bidfloor: c.floorPriceCents / 100,
                            bidfloorcur: f.toUpperCase(),
                            secure: "https:" === window.location.protocol ? 1 : 0
                        }],
                        site: {
                            domain: window.location.hostname,
                            page: window.location.href,
                            publisher: {
                                id: h.pubid
                            }
                        },
                        device: {
                            ua: window.navigator.userAgent,
                            language: c.language.substring(0, 2)
                        },
                        at: 1
                    };
                return (!0 === c.autoplay || "viewable" === c.autoplay && c.viewable) && (v.tmax = c.bidTimeout),
                    function() {
                        var t = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : 1e3;
                        return Promise.race([new Promise(function(e) {
                            Vt("getConsentData", null, e)
                        }), new Promise(function(e) {
                            setTimeout(e, t, {
                                gdprApplies: !0,
                                consentData: ""
                            })
                        })])
                    }().then(function(e) {
                        var t = e.gdprApplies,
                            i = e.consentData;
                        v.regs = {
                            ext: {
                                gdpr: t ? 1 : 0
                            }
                        }, t && (v.user = {
                            ext: {
                                consent: i
                            }
                        })
                    }).then(function() {
                        return new Promise(function(e) {
                            var t = new XMLHttpRequest;
                            t.onreadystatechange = function() {
                                4 === this.readyState && (e(this), t = null)
                            }, t.open("POST", r.endpoint), r.preflight && (t.setRequestHeader("content-type", "application/json"), t.setRequestHeader("x-openrtb-version", "2.5")), t.withCredentials = !0, t.send(JSON.stringify(v)), i.then(function() {
                                t && (t.abort(), t = null)
                            })
                        })
                    }).then(function(e) {
                        if (200 === e.status) {
                            var t = JSON.parse(e.responseText);
                            if (t.id === v.id && t.seatbid && t.seatbid.length) {
                                var r = void 0,
                                    i = t.seatbid.reduce(function(e, t) {
                                        if (null === e && t && t.bid && t.bid.length) {
                                            var i = t.bid.filter(function(e) {
                                                return e.impid === v.imp[0].id
                                            });
                                            if (i.length) return r = t.seat, i[0]
                                        }
                                        return e
                                    }, null);
                                if (i) {
                                    if (i.adm) {
                                        var n = m.parseXML(i.adm);
                                        if (null === n) return {
                                            result: At,
                                            code: 331
                                        };
                                        i.adm = Lt(n.documentElement)
                                    } else if (!i.nurl) return {
                                        result: At,
                                        code: 330
                                    };
                                    var a = {
                                            id: v.id,
                                            bid: t.bidid,
                                            imp: i.impid,
                                            seat: r,
                                            ad: i.adid,
                                            cur: t.cur || f
                                        },
                                        s = {
                                            result: gt,
                                            priceInCents: 100 * i.price,
                                            priceCurrency: t.cur || f,
                                            adm: i.adm ? Bt(i.adm, a) : null,
                                            custom: {
                                                exp: i.exp,
                                                nurl: i.nurl ? Bt(i.nurl, a) : null,
                                                lurl: i.lurl ? Bt(i.lurl, a) : null
                                            }
                                        };
                                    if (c.mediationLayerAdServer === Ne || c.mediationLayerAdServer === Xe) {
                                        var o, d = m.genId(12),
                                            l = h.name.toLowerCase();
                                        s.adm || (s.adm = (u = d, p = s.custom.nurl, '\n<VAST version="4.0">\n    <Ad id="' + u + '">\n        <Wrapper>\n            <AdSystem version="0.2.10">JWP</AdSystem>\n            <VASTAdTagURI><![CDATA[' + p + "]]></VASTAdTagURI>\n        </Wrapper>\n    </Ad>\n</VAST>\n")), s.cacheKey = d, s.custParams = ((o = {})[["vpb_" + l + "_key"]] = d, o[["vpb_" + l + "_bid"]] = parseFloat(i.price).toFixed(2), o)
                                    }
                                    return s
                                }
                            }
                            return {
                                result: Pt,
                                code: void 0 !== t.nbr ? t.nbr + 400 : bt[Pt]
                            }
                        }
                        var u, p;
                        return 204 === e.status ? {
                            result: Pt
                        } : 400 === e.status ? {
                            result: At
                        } : {
                            result: yt
                        }
                    })
            }
        },
        Dt = encodeURIComponent(window.location.href);
    var jt = {
            requestBids: function(e, f, i) {
                var t, r, n, a, s, o, v = e.id,
                    d = (t = v, r = f.playerWidth, n = f.playerHeight, ["https://an.facebook.com/v2/placementbid.json?&placementids[]=" + t, "&playerwidth=" + r, "&playerheight=" + n, "&adformats[]=" + Be, "&SDK[]=" + He, "&pageurl=" + Dt, "$random=" + Math.random() * Math.pow(10, 18)].join(""));
                return a = f.mediationLayerAdServer, s = f.floorPriceCents, o = f.floorPriceCurrency || Z, d && (a === Ne || s && o === Z) ? new Promise(function(e) {
                    var t = new XMLHttpRequest;
                    t.onreadystatechange = function() {
                        4 === this.readyState && (e(this), t = null)
                    }, t.open("GET", d), t.withCredentials = !0, t.send(null), i.then(function() {
                        t && (t.abort(), t = null)
                    })
                }).then(function(e) {
                    if (200 !== e.status) return {
                        result: yt,
                        message: "Invalid response (status " + e.status + ")"
                    };
                    var t, i, r = JSON.parse(e.responseText),
                        n = r.errors,
                        a = r.request_id;
                    if (n && n.length) return {
                        result: At,
                        code: (t = n[0], i = Ct.filter(function(e) {
                            return 0 <= t.indexOf(e.message)
                        })[0], i ? i.code : Et),
                        requestId: a
                    };
                    var s = r.bids;
                    if (!s || !s[v] || !s[v][0]) return {
                        result: Pt,
                        requestId: a
                    };
                    var o = s[v][0],
                        d = o.bid_price_cents,
                        l = o.bid_id;
                    if (f.mediationLayerAdServer === Ne) return {
                        result: gt,
                        tag: f.tag,
                        custParams: {
                            jwFANBidPrice: Math.round(d / 100),
                            jwFANBidID: l
                        },
                        requestId: a
                    };
                    var u, p, h, c, m = {
                        result: gt,
                        priceInCents: d,
                        priceCurrency: o.bid_price_currency,
                        requestId: a
                    };
                    return d >= f.floorPriceCents && (m.tag = (u = v, p = l, h = f.playerWidth, c = f.playerHeight, ["https://an.facebook.com/v1/instream/vast.xml?placementid=" + u, "&playerwidth=" + h, "&playerheight=" + c, "&SDK[]=" + He, "&bidid=" + p, "&pageurl=" + Dt].join(""))), m
                }).catch(function(e) {
                    return {
                        result: yt,
                        message: "FAN header bidding failed: " + e
                    }
                }) : Promise.resolve({
                    result: At
                })
            }
        },
        Nt = null;

    function Ft() {
        return null === Nt && (Nt = Promise.resolve(window.apstag).then(function(e) {
            return e && e.init && e.fetchBids ? e : Mt(["file" === document.location.protocol ? "https:" : "", Ve].join(""), Y).then(function() {
                return window.apstag
            })
        }).catch(function(e) {
            throw Nt = null, e
        })), Nt
    }
    var Ut = null,
        Xt = null;

    function Wt(e) {
        if (null === Xt) {
            var t = St(),
                i = Ut || window.SpotX;
            if (i && i.DirectAdOS) return Xt = Promise.resolve({
                SpotX: i,
                loadingTime: 0
            });
            var r = ["file" === document.location.protocol ? "https:" : "", De, e, ".js"].join("");
            (Xt = "function" == typeof require ? (n = r, a = Y, new Promise(function(e, t) {
                setTimeout(t, a), require([n], e, t)
            }).catch(function() {
                return Promise.reject({
                    message: Ge
                })
            })).then(function(e) {
                return {
                    SpotX: Ut = e,
                    loadingTime: St() - t
                }
            }).catch(function() {
                return Qt(r, t)
            }) : Qt(r, t)).catch(function() {
                Xt = null
            })
        }
        var n, a;
        return Xt
    }

    function Qt(e, t) {
        return Mt(e, Y).then(function() {
            return {
                SpotX: window.SpotX,
                loadingTime: St() - t
            }
        })
    }
    var zt = void 0;
    var $t = {
            postAuctionHandler: function(e) {
                return e.scriptLoadingTime = zt, e
            },
            requestBids: function(e, l) {
                if (!e.id) return Promise.resolve({
                    result: At,
                    code: 302
                });
                var t = {
                        placement: xt(l.outstream),
                        hide_skin: !0,
                        no_vpaid_ads: !1
                    },
                    i = {
                        channel_id: e.id,
                        slot: l.playerContainer,
                        content_width: l.playerWidth,
                        content_height: l.playerHeight,
                        player_vendor: "SpotXJW",
                        player_vendor_id: l.playerId,
                        ad_volume: l.adVolume,
                        ad_mute: l.mute ? 1 : 0,
                        autoplay: l.autoplay,
                        blocked_autoplay_override_mode: l.autoplayAdsMuted,
                        start_delay: Ot(l.offset)
                    },
                    a = _e(t, e.optionalParams, i);
                return e.passFloorPrice && l.floorPriceCents && (a.price_floor = l.floorPriceCents / 100), Wt(e.id).then(function(e) {
                    var t = e.SpotX,
                        i = e.loadingTime;
                    zt = i;
                    var r = new t.DirectAdOS(a),
                        n = St();
                    return r.getAdServerKVPs().then(function(e) {
                        return {
                            response: e,
                            bidNetworkStartTime: n
                        }
                    })
                }).then(function(e) {
                    var t = e.response,
                        i = e.bidNetworkStartTime,
                        r = St() - i,
                        n = t.spotx_ad_key,
                        a = {
                            spotx_bid: t.spotx_bid,
                            spotx_ad_key: n
                        },
                        s = 100 * parseFloat(t.spotx_bid),
                        o = {
                            result: gt,
                            priceInCents: s,
                            custParams: a,
                            scriptLoadingTime: zt,
                            bidNetworkResponseTime: r
                        };
                    if (l.mediationLayerAdServer === Ne) return o;
                    var d = ["file:" === document.location.protocol ? "https:" : "", je, n].join("");
                    return _e(o, {
                        tag: d,
                        tagKey: n
                    })
                }).catch(function(t) {
                    var e = It.filter(function(e) {
                        return e.message === t.message
                    })[0];
                    return e ? {
                        result: e.result || At,
                        code: e.code,
                        scriptLoadingTime: zt
                    } : {
                        result: yt,
                        message: "SpotX header bidding failed: " + t,
                        scriptLoadingTime: zt
                    }
                })
            }
        },
        Jt = null;

    function Kt(t) {
        return null === Jt && (Jt = Promise.resolve(window.indexapi).then(function(e) {
            return e || Mt(["file" === document.location.protocol ? "https:" : "", t || qe].join(""), Y).then(function() {
                return window.indexapi
            })
        }).catch(function(e) {
            throw Jt = null, e
        })), Jt
    }
    var Gt, Yt = {
            requestBids: function(e, r) {
                if (!e.id && !e.script) return Promise.resolve({
                    result: At
                });
                var t = _e({
                    videoCommonArgs: {
                        protocols: [2, 3, 5, 6],
                        mimes: ["video/mp4", "video/webm", "application/javascript"],
                        apiList: [1, 2]
                    },
                    siteID: e.id
                }, e);
                return Kt().then(function(e) {
                    return new Promise(function(i) {
                        e.deferQueue = e.deferQueue || [], e.deferQueue.push(function() {
                            e.solicitIndexVideoAds(r.tag, function(e, t) {
                                i({
                                    updatedTag: e,
                                    indexTargeting: t
                                })
                            }, t)
                        })
                    })
                }).then(function(e) {
                    var t = e.indexTargeting;
                    return void 0 !== t ? {
                        result: gt,
                        tag: r.tag,
                        custParams: t
                    } : {
                        result: Pt
                    }
                }).catch(function(e) {
                    return {
                        result: yt,
                        message: "Index Exchange header bidding failed: " + e
                    }
                })
            }
        },
        Zt = ((Gt = {})[[Qe]] = {
            requestBids: function(i, r) {
                return i.id && i.slotID ? Ft().then(function(t) {
                    return t.init({
                        id: i.pubId,
                        adServer: i.adServer
                    }), new Promise(function(e) {
                        t.fetchBids({
                            slots: [{
                                slotID: i.slotID
                            }],
                            timeout: r.bidTimeout
                        }, e)
                    })
                }).then(function(e) {
                    return e && e[0] && e[0].slotID === i.slotID ? {
                        result: gt,
                        tag: r.tag,
                        custParams: {
                            amznbid: e[0].amznbid,
                            amzniid: e[0].amzniid
                        }
                    } : {
                        result: Pt
                    }
                }).catch(function(e) {
                    return {
                        result: yt,
                        message: "Amazon header bidding failed: " + e
                    }
                }) : Promise.resolve({
                    result: At
                })
            }
        }, Gt[["FAN"]] = jt, Gt[[ze]] = Yt, Gt[[$e]] = qt, Gt[[Je]] = $t, Gt),
        ei = function(t, n, a) {
            var s = t.filter(function(e) {
                return e.result === gt && e.adm && e.cacheKey
            });
            return 0 === s.length ? Promise.resolve(t) : new Promise(function(t) {
                var e = s.map(function(e) {
                        return {
                            type: "xml",
                            ttlseconds: (e.custom || {}).exp || 86400,
                            value: a.getTrackingPixelURLs ? function(e, t) {
                                var i = t.parseXML(e.adm);
                                if (null === i) return e.adm;
                                for (var r = t.getTrackingPixelURLs(e.name, e.cacheKey), n = r.impression, a = r.error, s = i.querySelectorAll("InLine,Wrapper"), o = 0; o < s.length; o += 1) s[o].appendChild(Rt(i, "Impression", n, {
                                    id: e.cacheKey
                                })), s[o].appendChild(Rt(i, "Error", a));
                                return Lt(i)
                            }(e, a) : e.adm,
                            key: e.cacheKey
                        }
                    }),
                    i = function(e) {
                        return function() {
                            t({
                                result: e,
                                code: this.status
                            }), r = null
                        }
                    },
                    r = new XMLHttpRequest;
                r.onreadystatechange = function() {
                    4 === this.readyState && (200 === this.status ? t({
                        result: gt
                    }) : t({
                        result: yt,
                        code: this.status
                    }), r = null)
                }, r.onabort = i(vt), r.onerror = i(yt), r.ontimeout = i(kt), r.open("POST", "https://vpb-cache.jwplayer.com/cache"), r.send(JSON.stringify({
                    puts: e
                })), n.then(function(e) {
                    var t = e.result;
                    r && (r.onabort = i(t), r.abort(), r = null)
                })
            }).then(function(e) {
                var r = e.result,
                    n = e.code;
                return s.forEach(function(e) {
                    var t, i;
                    e.result = r, e.result === yt && (e.code = (t = n, i = 100 * parseInt(t / 100, 10), Tt[t] || Tt[i] || _t))
                }), t
            })
        };
    var ti = function() {
            function m() {
                var e, t, i, r = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : {},
                    n = r.settings,
                    a = void 0 === n ? {} : n,
                    s = r.bidders,
                    o = void 0 === s ? [] : s,
                    d = this,
                    l = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : {},
                    u = arguments[2];
                y(this, m), this.settings = (e = a, i = _e({
                    bidTimeout: G,
                    offset: "",
                    playerContainer: (t = l).container,
                    playerHeight: t.height || 0,
                    playerWidth: t.width || 0,
                    tag: ""
                }, t, e), Ke[i.mediationLayerAdServer] || (i.mediationLayerAdServer = We), i.mediationLayerAdServer === Ue && (i.floorPriceCents = ee), i), this.utils = u;
                var p = 0 === Ot(this.settings.offset),
                    h = this.settings.mediationLayerAdServer === Fe || this.settings.mediationLayerAdServer === Xe,
                    c = Ke[this.settings.mediationLayerAdServer];
                this.bidders = o.filter(function(e) {
                    return (!isNaN(parseFloat(d.settings.floorPriceCents)) || !h) && (-1 !== c.indexOf(e.type || e.name) && (p || e.type === $e || e.name === Je))
                }).map(function(e) {
                    return e.name === Qe && e.id && e.slotID ? Ft() : e.name === ze && (e.script || e.id) ? Kt(e.script) : e.name === Je && e.id && Wt(e.id), _e(e, e.custom_params)
                }), this._bidRequest = null, this._currentTimeout = null, this._onCancelTrigger = null, this.onCancel = new Promise(function(e) {
                    d._onCancelTrigger = e
                })
            }
            return m.prototype.start = function() {
                var e, t, r, n, a, i, s, o;
                return this._bidRequest || (this._bidRequest = (e = {
                    bidders: this.bidders,
                    settings: this.settings,
                    onCancel: this.onCancel,
                    utils: this.utils
                }, t = e.bidders, r = e.settings, n = e.onCancel, a = e.utils, i = r.mediationLayerAdServer === Ne || r.mediationLayerAdServer === Xe, s = r.mediationLayerAdServer === Fe || r.mediationLayerAdServer === Xe || r.mediationLayerAdServer === Ue, o = t.map(function(t) {
                    var i = St();
                    return Promise.race([Zt[t.type || t.name].requestBids(t, r, n, a), n]).then(function(e) {
                        return _e({}, t, e, {
                            timeForBidResponse: St() - i | 0
                        }, s && {
                            winner: !1
                        })
                    }).catch(function(e) {
                        return _e({}, t, {
                            result: yt,
                            code: wt,
                            message: e,
                            timeForBidResponse: St() - i | 0
                        })
                    })
                }), Promise.all(o).then(function(e) {
                    if (s) {
                        var t = e.reduce(function(e, t) {
                            return t.result === gt && (t.priceInCents > e.priceInCents || t.priceInCents === e.priceInCents && t.timeForBidResponse < e.timeForBidResponse) ? (e.winner = !1, t.winner = !0, t) : e
                        }, {
                            priceInCents: r.floorPriceCents,
                            timeForBidResponse: 1 / 0
                        });
                        if (t.winner) return {
                            bidders: e,
                            result: t
                        }
                    }
                    return i ? ei(e, n, a).then(function(e) {
                        var t = e.reduce(function(e, t) {
                                return t.result === gt ? _e(e || {}, t.custParams) : e
                            }, null),
                            i = {
                                bidders: e
                            };
                        return null !== t && (i.result = {
                            tag: r.tag,
                            custParams: t
                        }), i
                    }) : {
                        bidders: e
                    }
                }).then(function(i) {
                    return i.bidders = i.bidders.map(function(e) {
                        e.code = e.code || bt[e.result];
                        var t = Zt[e.type || e.name];
                        return "function" == typeof t.postAuctionHandler ? t.postAuctionHandler(e, i.result) : e
                    }), i
                }))), this._bidRequest
            }, m.prototype.stop = function() {
                var t = this;
                clearTimeout(this._currentTimeout), this._onCancelTrigger({
                    result: vt
                }), this._bidRequest = null, this._currentTimeout = null, this._onCancelTrigger = null, this.onCancel = new Promise(function(e) {
                    t._onCancelTrigger = e
                })
            }, m.prototype.getEventObject = function(e, t, i) {
                var r = i.offset,
                    n = i.adBreakId,
                    a = i.adPlayId,
                    s = this.settings.mediationLayerAdServer,
                    o = t || [];
                0 === Ot(r) || (o = o.filter(function(e) {
                    return e.type === $e || e.name === Je
                }));
                var d = {
                        client: e,
                        bidsVersion: "0.2.10",
                        offset: r,
                        mediationLayerAdServer: s,
                        bidders: o,
                        adBreakId: n,
                        adPlayId: a,
                        bidTimeout: this.settings.bidTimeout
                    },
                    l = +this.settings.floorPriceCents || 0;
                s !== Ue && s !== Ne && (d.floorPriceCents = l);
                var u = this.settings.floorPriceCurrency;
                return u && (d.floorPriceCurrency = u), d
            }, m.prototype.then = function(e) {
                return this._bidRequest ? this._bidRequest.then(e, e) : null
            }, m.prototype.timeout = function() {
                clearTimeout(this._currentTimeout), this._currentTimeout = setTimeout(this._onCancelTrigger, this.settings.bidTimeout, {
                    result: kt
                })
            }, m
        }(),
        ii = 0,
        ri = function() {
            function s(i, e, t, r, n) {
                var a = this;
                y(this, s), this.config = r, this.item = t, this.params = n, this.player = i, this.schedule = e, this.adIds = {}, this.vmapPromise = null, this._preRollPromise = null, this._midRollPromise = {}, this._postRollPromise = null, this.vmapTracker = null, this._errors = [], this._vloaderQueue = [], this._staticAdsOffset = [], this.bids = [], this.bidsPromise = null, this.bidsResult = {}, this._debugTrackFn = r.debug && r.trackFn ? r.trackFn : null, _e(this, i.Events), this.trigger = function(e, t) {
                    return t.item = a.item, i.Events.trigger.call(a, e, t)
                }
            }
            return s.prototype.init = function(e) {
                var t = this,
                    i = this.schedule;
                return i.isVMAP() && (this.vmapPromise = i._vmapPromise.catch(this.player.utils.noop)), this.bidsPromise = this.vmapPromise || Promise.resolve(), null !== e && (this.bidsPromise = this.bidsPromise.then(function() {
                    return t.isDestroyed() ? null : t._createBidsPromise(e)
                })), this.bidsPromise
            }, s.prototype._createBidsPromise = function(i) {
                var d = this,
                    r = this.player,
                    e = parseInt(i.bidOnBreaks, 10);
                return e = 0 < e ? e : 1 / 0, this.bids = this.schedule.getAllAds().slice(0, e).map(function(n) {
                    var e = d.getAdIds(n),
                        a = e.adBreakId,
                        s = e.adPlayId,
                        o = new ti(i, {
                            adPlayId: s,
                            offset: n._offSet,
                            width: r.getWidth(),
                            height: r.getHeight(),
                            container: r.getContainer(),
                            playerId: r.id,
                            autoplay: r.getConfig().autostart,
                            autoplayAdsMuted: d.config.autoplayadsmuted,
                            adVolume: r.getVolume(),
                            mute: r.getMute(),
                            outstream: d.config.outstream,
                            skipoffset: d.config.skipoffset,
                            language: d.config.locale || r.getConfig().language,
                            viewable: 1 === r.getViewable()
                        }, {
                            genId: Ee,
                            parseXML: r.utils.parseXML
                        });
                    o.start();
                    var t = o.getEventObject(te, i.bidders, {
                        offset: n._offSet,
                        adBreakId: a,
                        adPlayId: s
                    });
                    return d.trigger(he, t), o.then(function(e) {
                        var t = e.bidders,
                            i = e.result;
                        if (!d.isDestroyed()) {
                            i && !i.error && (i.adm ? n._adXML = i.adm : i.tag && (n._adQueue = n._adQueue || [], n._adQueue[0] = i.tag)), d.bidsResult[n._vmap ? n._vmap.breakid : n._breakId] = {
                                bid: o,
                                bidders: t
                            };
                            var r = o.getEventObject(te, t, {
                                offset: n._offSet,
                                adBreakId: a,
                                adPlayId: s
                            });
                            d.trigger(ce, r)
                        }
                    }), o
                }), Promise.all(this.bids)
            }, s.prototype.getAdIds = function(e) {
                var t = e._offSet;
                this.adIds[t] = this.adIds[t] || {
                    adBreakId: Ee(12),
                    adPlayIds: {}
                };
                var i = this.adIds[t].adPlayIds,
                    r = "p" + (e._adPodIndex || 0) + "w" + e._waterfallIndex,
                    n = i[r];
                return n || (i[r] = n = Ee(12)), {
                    adBreakId: this.adIds[t].adBreakId,
                    adPlayId: n
                }
            }, s.prototype.loadPreRoll = function() {
                var t = this,
                    i = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : {};
                return null === this._preRollPromise && (this._preRollPromise = this.bidsPromise.then(function() {
                    if (!t.isDestroyed()) {
                        var e = t.schedule.getPreRoll(i.startTime);
                        return e ? (e._position = "pre", t.loadAd(e, i)) : void 0
                    }
                })), this._preRollPromise
            }, s.prototype.loadMidRollAtIndex = function(t, i) {
                var r = this;
                return this._midRollPromise[t] || (this._midRollPromise[t] = this.bidsPromise.then(function() {
                    if (!r.isDestroyed()) {
                        var e = r.schedule.getMidRollAtIndex(t);
                        return e ? (e._position = "mid", r.loadAd(e, i)) : void 0
                    }
                })), this._midRollPromise[t]
            }, s.prototype.loadPostRoll = function() {
                var t = this,
                    i = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : {};
                return null === this._postRollPromise && (this._postRollPromise = this.bidsPromise.then(function() {
                    if (!t.isDestroyed()) {
                        var e = t.schedule.getPostRoll(i.startTime);
                        return e ? (e._position = "post", t.loadAd(e, i)) : void 0
                    }
                })), this._postRollPromise
            }, s.prototype.loadAd = function(e) {
                var t = this,
                    i = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : {},
                    r = this.player.utils;
                if (e._id = e._id || Ee(12), this.config.preloadAds && (e._preload = e._preload || i.preload || !1), e._vmapTracker = this.getVMAPTracker(e), e._adXML) e.currentTag = e._currentTag || "clientloadedtag_" + ii++;
                else if (!e._adQueue) return void r.log("scheduled ad has no url or xml", e);
                var n = e._adXML ? this._loadXML(e, i) : this._loadTag(e, i);
                return n.then(function() {
                    return t.isDestroyed() ? null : t._dispatchAdLoaded(e)
                }).catch(r.noop), n.catch(function() {
                    return t.isDestroyed() ? null : t._dispatchAdLoaded(e)
                }).catch(r.noop), n.catch(function(e) {
                    return t.isDestroyed() ? null : t._vloaderWaterfall(e, i)
                })
            }, s.prototype.getVMAPTracker = function(e) {
                if (!e._vmapTracker) {
                    var t = new b(e._trackers, this._debugTrackFn, this.player, this.config.trackingFilter);
                    e._vmapTracker = this.vmapTracker = t
                }
                return e._vmapTracker
            }, s.prototype._loadTag = function(e, t) {
                var i = e._adQueue[e._waterfallIndex],
                    r = Le(i, this.player, this.params);
                if (e._currentTag = r, "function" == typeof this._debugTrackFn && this._debugTrackFn({
                        type: "tagReplacement",
                        data: {
                            actualTag: r,
                            originalTag: i
                        }
                    }), t.adBlock) throw this._adBlockDetected(e);
                var n = this._createVastLoader(e).load(r);
                return this._dispatchAdRequest(e, r), n
            }, s.prototype._loadXML = function(e, t) {
                if (e._currentTag = e._currentTag || e._adXML.toString(), t.adBlock) throw this._adBlockError(e);
                var i = this._createVastLoader(e).parseXMLString(e._adXML);
                return this._dispatchAdRequest(e, e._currentTag), i
            }, s.prototype._adBlockError = function(e) {
                var t = this.getAdEventObject(e),
                    i = Ie("Ad playback blocked by an ad blocker", 900, 600003);
                return _e(t, i)
            }, s.prototype._dispatchAdRequest = function(e, t) {
                this.trigger(Pe, this.getAdEventObject(e, t))
            }, s.prototype._dispatchAdLoaded = function(e) {
                this.trigger(Ae, this.getAdEventObject(e))
            }, s.prototype._vloaderWaterfall = function(e, t) {
                var i = e.vloader;
                this.removeVastLoader(i);
                var r = this._getVloaderErrorObject(e);
                return this.adWaterfall(i, t, r)
            }, s.prototype.adWaterfall = function(e, t, i) {
                var r = e.scheduledAd();
                if (this.schedule.canWaterfall(r)) return r._waterfallIndex += 1, this._enqueueAdError(r, i), this.loadAd(r, t);
                throw i
            }, s.prototype.getAdEventObject = function(e, t) {
                return _e((r = t, n = {}, void 0 !== (i = e)._preload && (n.preloadAds = i._preload), void 0 !== i.skipoffset && (n.skipoffset = i.skipoffset), i._adbreak && (n.adschedule = i._adbreak, n.adschedule.offset = i._offSet), _e(n, {
                    id: i._id,
                    tag: r || i._currentTag,
                    client: te,
                    adposition: i._position,
                    offset: i._offSet,
                    witem: i._waterfallIndex + 1,
                    wcount: i._adQueue ? i._adQueue.length : 1
                })), this.getAdIds(e));
                var i, r, n
            }, s.prototype.addStaticOffset = function(e) {
                this._staticAdsOffset.push(e)
            }, s.prototype.clearAdIds = function(e) {
                this._staticAdsOffset.indexOf(e._offSet) < 0 && (this.adIds[e._offSet] = null)
            }, s.prototype._createVastLoader = function(i) {
                var r = this,
                    e = this.config,
                    t = new K(i, this.player, {
                        requestFilter: e.requestFilter,
                        trackingFilter: e.trackingFilter
                    });
                return this._vloaderQueue.push(t), t.on(pe, function(e) {
                    var t = r._getVloaderErrorObject(e);
                    r._enqueueAdError(i, t)
                }), t
            }, s.prototype._getVloaderErrorObject = function(e) {
                var t = e.vloader,
                    i = this.getAdEventObject(t.scheduledAd(), e.url),
                    r = Ie(e.message, e.code, e.adErrorCode);
                return _e(i, r), e.wrappedTags && e.wrappedTags !== e.url && (e.wrapperAdSystem && e.wrapperAdSystem.length !== e.wrappedTags.length && (e.wrapperAdSystem.push(e.adsystem), e.adsystem = ""), i.tag = e.wrappedTags.pop(), i.wrappedTags = e.wrappedTags, i.adsystem = e.adsystem, i.wrapperAdSystem = e.wrapperAdSystem), i
            }, s.prototype._enqueueAdError = function(e, t) {
                this._errors.push(t), e._preload || this.dequeueAdErrors()
            }, s.prototype.dequeueAdErrors = function() {
                var t = this;
                this._errors.forEach(function(e) {
                    return t.trigger(ge, e)
                }), this._errors.splice(0)
            }, s.prototype.removeVastLoader = function(e) {
                var t = this._vloaderQueue.indexOf(e); - 1 !== t && (e.destroy(), this._vloaderQueue.splice(t, 1))
            }, s.prototype.isDestroyed = function() {
                return null === this.player
            }, s.prototype.destroy = function() {
                this.bids.forEach(function(e) {
                    return e.stop()
                }), this._vloaderQueue.forEach(function(e) {
                    return e.destroy()
                }), this.player = null
            }, s
        }(),
        ni = document.createElement("img"),
        ai = document.createElement("img");
    ni.src = ai.src = 'data:image/svg+xml;charset=UTF-8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"><circle cx="32" cy="32" r="32" fill="%23191919"/><line stroke="%23CCC" stroke-width="6" x1="32" y1="20" x2="32" y2="44"/><line stroke="%23CCC" stroke-width="6" x1="20" y1="32" x2="44" y2="32"/></svg>', ni.className = "jw-vast-nonlinear-open-button", ai.className = "jw-vast-nonlinear-close-button";
    var si = {
            cursor: "pointer",
            position: "absolute",
            margin: "auto",
            left: 0,
            right: 0,
            bottom: 0,
            display: "block"
        },
        oi = "opacity 0.2s",
        di = {
            "-webkit-transition": oi,
            transition: oi
        };

    function li(e, t) {
        Te.utils.style(e, {
            opacity: t || 1
        })
    }

    function ui(e) {
        Te.utils.style(e, {
            opacity: 0
        })
    }

    function pi() {
        li(ai)
    }

    function hi() {
        li(ai, .75)
    }

    function ci() {
        li(ni)
    }

    function mi() {
        li(ni, .5)
    }
    var fi = function() {
            function a(e, t, i, r, n) {
                y(this, a), this.player = e, this.environment = e.getEnvironment(), this.div = r, this.staticURL = t, this.clickURL = i, this.loadTimer = -1, this.animationTimer = -1, this.banner = null, _e(this, e.Events), this.banner = document.createElement("img"), this.banner.className = "jw-banner", this.banner.id = this.player.id + "_vast_static", ui([ai, ni]), this.remove(ni), this.div.appendChild(this.banner), this.div.appendChild(ai), this.loadTimer = setTimeout(this.imageLoadError.bind(this), n), this.banner.onerror = this.imageLoadError.bind(this), this.banner.onload = this.onLoaded.bind(this), this.banner.src = this.staticURL
            }
            return a.prototype.onLoaded = function() {
                clearTimeout(this.loadTimer), 0 !== this.banner.naturalWidth ? (this.removeBannerEventListeners(), Te.utils.style(ai, {
                    top: -this.banner.height - 8,
                    bottom: this.banner.height - 8,
                    left: this.banner.width
                }, !0), Te.utils.style(ni, {
                    top: -16
                }, !0), li([this.div, this.banner]), li(ai, .75), new Te.utils.UI(this.banner).on("click tap", this.sendClick.bind(this)), this.environment.OS.mobile && (this.div.onmouseover = pi, this.div.onmouseout = hi), ai.onclick = ai.ontouchstart = this.collapse.bind(this), ni.onclick = ni.ontouchstart = this.expand.bind(this), this.trigger(c)) : this.imageLoadError()
            }, a.prototype.imageLoadError = function() {
                clearTimeout(this.loadTimer), this.trigger(m), this.removeBanner()
            }, a.prototype.sendClick = function() {
                this.trigger(s)
            }, a.prototype.collapse = function(e) {
                var t = this; - 1 === this.animationTimer && (e.preventDefault(), this.div.onmouseover = this.div.onmouseout = null, ui([this.banner, ai, ni]), this.div.appendChild(ni), this.animationTimer = setTimeout(function() {
                    t.remove(t.banner), t.remove(ai), li(ni, .5), t.div.onmouseover = ci, t.div.onmouseout = mi, t.animationTimer = -1
                }, 250))
            }, a.prototype.expand = function(e) {
                var t = this; - 1 === this.animationTimer && (e.preventDefault(), this.div.onmouseover = this.div.onmouseout = null, this.div.appendChild(this.banner), this.div.appendChild(ai), this.animationTimer = setTimeout(function() {
                    li([t.banner, ai]), t.div.onmouseover = pi, t.div.onmouseout = hi, t.animationTimer = -1
                }, 50), ui(ni))
            }, a.prototype.remove = function(e) {
                this.div.contains(e) && this.div.removeChild(e)
            }, a.prototype.removeBannerEventListeners = function() {
                this.banner.onload = this.banner.onerror = null
            }, a.prototype.removeBanner = function() {
                this.removeBannerEventListeners(), this.remove(this.banner)
            }, a.prototype.removeListeners = function() {
                clearTimeout(this.loadTimer), clearTimeout(this.animationTimer), this.div.onmouseover = this.div.onmouseout = ai.onclick = ni.onclick = null, this.off(), this.removeBannerEventListeners()
            }, a.prototype.stop = function() {
                ui([this.div, this.banner, ai, ni]), setTimeout(this.removeBanner.bind(this), 400), this.remove(ai), this.remove(ni)
            }, a
        }(),
        vi = function() {
            function i(e, t) {
                y(this, i), this.player = e, this.div = t, this.startTime = 0, this.minDur = 0, this.environment = e.getEnvironment(), _e(this, e.Events), this.type = "static", e.on("time", this.dispatchTime, this)
            }
            return i.prototype.playAd = function(e, t, i, r, n) {
                this.minDur = Te.utils.seconds(i), this.adTag = r, this.static && (this.static.removeListeners(), this.static.stop()), this.div.style.opacity = 0, this.div.style.visibility = "visible";
                var a = this.environment.Browser.firefox ? {} : di;
                Te.utils.style(this.div, Te.utils.extend({
                    top: "",
                    position: "absolute",
                    width: "100%"
                }, a)), Te.utils.style([ai, ni], _e({
                    width: "18px",
                    height: "18px",
                    opacity: .75
                }, si, a)), Te.utils.style(ai, {
                    transform: "rotate(45deg)"
                }), this.static = new fi(this.player, e, t, this.div, n), this.static.on(c, this.startAd, this), this.static.on(s, this.clickHandler, this), this.static.on(m, this.errorHandler, this)
            }, i.prototype.dispatchTime = function(e) {
                this.trigger(t, e)
            }, i.prototype.startAd = function() {
                this.startTime = this.player.getPosition(), 0 < this.minDur && (0 === this.startTime ? this.on(t, this.startTimingAd, this) : this.on(t, this.timeAd, this)), this.sendEvent(c)
            }, i.prototype.startTimingAd = function(e) {
                this.startTime = e.position, this.off(t, this.startTimingAd, this), this.on(t, this.timeAd, this)
            }, i.prototype.timeAd = function(e) {
                e.position - this.startTime > this.minDur && (this.off(t, this.timeAd, this), this.stop())
            }, i.prototype.clickHandler = function() {
                this.sendEvent(s)
            }, i.prototype.errorHandler = function() {
                this.sendEvent(m)
            }, i.prototype.sendEvent = function(e, t) {
                (t = t || {}).tag = t.tag || this.adTag, this.trigger(e, t)
            }, i.prototype.removeEvents = function() {
                this.off()
            }, i.prototype.getState = function() {
                return ue
            }, i.prototype.stop = function() {
                this.startTime && this.static && (this.startTime = 0, this.minDur = 0, this.off(t, this.startTimingAd, this), this.off(t, this.timeAd, this), this.static.removeListeners(), this.static.stop(), this.sendEvent(f))
            }, i.prototype.pause = function() {}, i
        }(),
        gi = function() {
            function i(e, t) {
                y(this, i), this.player = e, this.options = t, this.ignoreStartOnSeek = !1, this.reset(), t.timeBetweenAds && e.on({
                    adBreakStart: this.handleAdBreakStart,
                    adSkipped: this.handleAdSkipped,
                    adComplete: this.handleAdComplete,
                    adBreakEnd: this.handleAdBreakEnd,
                    destroyPlugin: this.destroy
                }, this)
            }
            return i.prototype.clearStartOnSeek = function() {
                this.ignoreStartOnSeek = !0
            }, i.prototype.sendAdBreakIgnored = function(e, t) {
                var i, r;
                e && this.player.trigger(n, (r = t, {
                    id: (i = e)._breakId,
                    tag: i._adQueue && 0 < i._adQueue.length ? i._adQueue[0] : i._adXML,
                    client: te,
                    offset: i._offSet,
                    timeSinceLastAd: r,
                    type: n
                }))
            }, i.prototype.rulesAllowAdPlayback = function(e) {
                var t = this.options,
                    i = 0 === t.frequency && 1 === e,
                    r = e >= t.startOn && (e - t.startOn) % t.frequency == 0;
                return i || r
            }, i.prototype.handleAdBreakStart = function() {
                this.adSkipped = !1, this.adComplete = !1
            }, i.prototype.handleAdComplete = function() {
                this.adComplete = !0
            }, i.prototype.handleAdSkipped = function() {
                this.adSkipped = !0
            }, i.prototype.handleAdBreakEnd = function() {
                !this.adSkipped && this.adComplete && (this.recentCompletedAdTime = xe())
            }, i.prototype.timeBetweenAdsAllowsAdPlayback = function(e) {
                var t = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : xe();
                if (this.options.timeBetweenAds) {
                    var i = (t - this.recentCompletedAdTime) / 1e3;
                    if (i < this.options.timeBetweenAds) return this.sendAdBreakIgnored(e, i), !1
                }
                return !0
            }, i.prototype.reset = function() {
                this.ignoreStartOnSeek = !1, this.recentCompletedAdTime = 0
            }, i.prototype.destroy = function() {
                this.player.off(null, null, this)
            }, A(i, [{
                key: "timeBetweenAds",
                get: function() {
                    return this.options.timeBetweenAds
                }
            }, {
                key: "startOnSeek",
                get: function() {
                    return this.ignoreStartOnSeek ? null : this.options.startOnSeek
                }
            }]), i
        }(),
        yi = {};
    (window.jwplayerPluginJsonp || window.jwplayer().registerPlugin)(te, "8.1", function(d, l, t) {
        var u = Te.utils = d.utils,
            p = Te._ = d._,
            r = d.getConfig(),
            e = r.key,
            n = d.getEnvironment(),
            a = l.debug && l.trackFn ? l.trackFn : null,
            h = this,
            c = null,
            i = l.bids && l.bids.settings ? l.bids.settings.mediationLayerAdServer || ae : null;
        if ((i === ae || i === se) && l.bids.bidders) {
            var s = l.bids.bidders;
            s.length && (c = _e({}, l.bids, {
                bidders: s
            }))
        }
        var m = {},
            o = !1,
            f = !1,
            v = void 0,
            g = [],
            y = !1,
            A = void 0,
            P = void 0,
            k = void 0,
            b = void 0,
            w = 0,
            _ = 0,
            T = !1,
            I = null,
            E = !1,
            C = void 0,
            S = new Me,
            R = new gi(d, S.getAdRules(l)),
            x = new jwplayer.utils.Timer;
        this.version = "8.5.14", this.bidsVersion = "0.2.10";
        var O = new Oe(R),
            M = S.getSchedule(l, R);
        if (M.isVMAP()) {
            var L = Le(M.getVMAP(), d, m);
            M.load(d, L).catch(u.noop)
        }

        function V(e) {
            H(), B(e);
            var t = v;
            Promise.resolve(e).then(function() {
                if (!t.isDestroyed()) return t.loadAd(e, {
                    adBlock: T
                })
            }).then(function(e) {
                return t.isDestroyed() ? null : j(e, we)
            }).catch(function(e) {
                return t.isDestroyed() ? null : z(e)
            })
        }

        function B(e) {
            var t = v.getVMAPTracker(e),
                i = v.getAdEventObject(e);
            b.once("destroyed", function() {
                x.clear("adBreakStart"), t.breakEnd(), d.trigger(me, i), v && v.clearAdIds(e)
            }), x.tick("adBreakStart"), t.breakStart(), d.trigger(fe, i)
        }

        function H() {
            b || (b = d.createInstream().init()).setText(null)
        }

        function q(t, e) {
            var i, r, n, a = (r = t, n = e, R.rulesAllowAdPlayback(n) ? p.isObject(r) && r.adschedule ? S.getSchedule(r, R) : M : O),
                s = new ri(d, a, t, l, m);
            if (s.on(((i = {})[[he]] = function(e) {
                    return d.trigger(he, e)
                }, i[[ce]] = function(e) {
                    return d.trigger(ce, e)
                }, i[[Pe]] = Q, i[[Ae]] = W, i[[ge]] = $, i), h), a.isVMAP()) {
                var o = Le(a.getVMAP(), d, m);
                a.load(d, o).then(function(e) {
                    s.isDestroyed() || e.forEach(function(e) {
                        return d.trigger(ge, e)
                    })
                }).catch(function(e) {
                    return s.isDestroyed() ? null : z(e)
                })
            }
            return s.init(c).then(function() {
                if (!s.isDestroyed()) {
                    var e = s.schedule.getAdScheduleEventObject();
                    e.adbreaks = e.adbreaks.map(function(e) {
                        return Ce(e, s.schedule, s.bidsResult)
                    }), e.item = t, d.trigger(ke, e)
                }
            }), s
        }

        function D() {
            v && (v.schedule.reset(), v.off(null, null, h), v.destroy(), v = null), N(), X(), U(), R.reset(), d.setCues([]), _ = 0, f = !1
        }

        function j(e, t) {
            if (e) {
                var i = e.scheduledAd();
                return v.dequeueAdErrors(), "nonlinear" === i._type && X(),
                    function(n, a) {
                        0 === n.scheduledAd()._waterfallIndex && U(), v.removeVastLoader(n);
                        var e = new Promise(function(e, t) {
                                var i = new Se(n, d, P, k, v, m);
                                i.on(ge, t), i.on(ye, F), i.on(pe, $);
                                var r = i.init(b, a);
                                if (!r) return i.destroy(), e();
                                A = b, b = null, i.on(ve, e), i.on(be, e), g.push(i)
                            }),
                            t = v;
                        return e.catch(function(e) {
                            if (!t.isDestroyed()) return b = b || A, t.adWaterfall(n, {
                                adBlock: T
                            }, e).then(function(e) {
                                return t.isDestroyed() ? null : j(e, a)
                            })
                        })
                    }(e, t)
            }
            X()
        }

        function N() {
            g.forEach(function(e) {
                return e.destroy()
            }), g.splice(0)
        }

        function F(e) {
            J(e) && (x.tick("adImpression" + e.id), e.timeLoading = x.between("adBreakStart", "adImpression" + e.id)), Ce(e, v.schedule, v.bidsResult), d.trigger(ye, e)
        }

        function U() {
            g.length && g[g.length - 1].clearNonlinear()
        }

        function X() {
            if (b || A) {
                var e = b || A;
                b = null, e.destroy()
            }
            A = null
        }

        function W(e) {
            var t = e.id;
            x.tick("adLoaded" + t), e.timeLoading = x.between("adLoading" + t, "adLoaded" + t), d.trigger(Ae, e)
        }

        function Q(e) {
            Ce(e, v.schedule, v.bidsResult), d.trigger(Pe, e), x.tick("adLoading" + e.id)
        }

        function z(e) {
            v.dequeueAdErrors(), $(e), N(), X()
        }

        function $(e) {
            J(e) && (x.tick("adError" + e.id), e.timeLoading = x.between("adBreakStart", "adError" + e.id)), _e(e, {
                client: te
            }), v.vmapTracker && v.vmapTracker.error(e.code), Ce(e, v.schedule, v.bidsResult), 50004 !== e.adErrorCode && 50901 !== e.adErrorCode || !d.getAdBlock() || (T = !0), o ? d.trigger(ge, e) : d.once("playlistItem", function() {
                d.trigger(ge, e)
            }, h)
        }

        function J(e) {
            return void 0 === e.podcount || 1 === e.sequence
        }

        function K(e) {
            var t = e.getMidRolls(),
                i = [];
            t.length && u.foreach(t, function(e, t) {
                "nonlinear" !== t._type && i.push({
                    begin: t._offSet,
                    text: m.cuetext
                })
            }), d.addCues(i)
        }
        _e(this, d.Events), u.addClass(t, "jw-plugin-vast"), d.on({
            ready: function() {
                var i = this;
                if (o = !0, P = new vi(d, t), k = new Re(a, n, {
                        openLink: d.utils.openLink
                    }), r.localization = d.getConfig().localization, (m = S.getOptParams(l, r.localization.advertising)).debugTrackFn = a, ee.catch(function(e) {
                        D(), d.off(null, null, i), d.playAd = u.noop;
                        var t = Ie("Ad Error: " + e.message, 0, 60002);
                        t.code = void 0, t.id = ie, t.client = te, t.tag = "", d.trigger(ge, t)
                    }), l.preloadAds) {
                    var e = d.getPlugin("related");
                    e && e.on("nextUp", function(e) {
                        e && "discovery" === e.mode && (C = e)
                    })
                }
            },
            beforePlay: function(i) {
                if (!y && !f) {
                    f = !0, v.bids.forEach(function(e) {
                        return e.timeout()
                    });
                    var t = (i || {}).startTime || d.getPosition();
                    _ = t || _;
                    var e = v.schedule.getPreRoll(t);
                    if (e || v.vmapPromise) {
                        (null !== v.vmapPromise || e && "nonlinear" !== e._type) && H();
                        var r = v;
                        r.bidsPromise.then(function() {
                            if (!r.isDestroyed()) {
                                var e = r.schedule.getPreRoll(t);
                                e && "nonlinear" !== e._type && B(e)
                            }
                        }), t ? "none" === R.startOnSeek && (v._preRollPromise = null) : R.clearStartOnSeek(), r.loadPreRoll({
                            adBlock: T,
                            startTime: t
                        }).then(function(e) {
                            var t = i && i.playReason ? i.playReason : we;
                            return r.isDestroyed() ? null : j(e, t)
                        }).catch(function(e) {
                            return r.isDestroyed() ? null : z(e)
                        })
                    }
                }
            },
            cast: function(e) {
                y = !!e.active
            },
            play: function(e) {
                h.trigger(ue, e)
            },
            time: function(e) {
                if (!y && 0 !== e.duration) {
                    var t = v.schedule.getNextMidrollIndex(_, e.position, e.duration);
                    if (_ = e.position, null !== t) {
                        var i = v.schedule.getMidRollAtIndex(t);
                        "nonlinear" !== i._type && (H(), B(i));
                        var r = v;
                        r.loadMidRollAtIndex(t, {
                            adBlock: T
                        }).then(function(e) {
                            return r.isDestroyed() ? null : j(e)
                        }).catch(function(e) {
                            return r.isDestroyed() ? null : z(e)
                        })
                    } else if (l.preloadAds) {
                        var n = e.position + le,
                            a = v.schedule.peek(e.position, n, e.duration);
                        if (null !== a && 0 <= a) v.loadMidRollAtIndex(a, {
                            adBlock: T,
                            preload: !0
                        }).catch(u.noop);
                        else if (-1 === a) {
                            var s = xe() + 1e3 * (e.duration - e.position);
                            v.loadPostRoll({
                                adBlock: T,
                                preload: !0,
                                startTime: s
                            }).catch(u.noop)
                        } else if (null === I && n > e.duration) {
                            var o = d.getPlaylistItem(d.getPlaylistIndex() + 1);
                            E = !o, (o || C) && ((I = q(o || C, w + 1)).loadPreRoll({
                                adBlock: T,
                                preload: !0
                            }).catch(u.noop), C = null)
                        }
                    }
                }
            },
            beforeComplete: function() {
                if (!y) {
                    var e = v.schedule.getPostRoll();
                    if (e) {
                        "nonlinear" !== e._type && (H(), B(e));
                        var t = v;
                        t.loadPostRoll({
                            adBlock: T
                        }).then(function(e) {
                            return t.isDestroyed() ? null : j(e)
                        }).catch(function(e) {
                            return t.isDestroyed() ? null : z(e)
                        })
                    }
                }
            },
            playlistItem: function(e) {
                w += 1, D();
                var t = d.getPlaylistItem(e.index);
                if (I && t !== I.item && !1 === E && (I.off(null, null, h), I.destroy(), I = null), v = I || q(t, w), I = null, v.schedule.isVMAP() ? v.vmapPromise.then(function() {
                        v.isDestroyed() || K(v.schedule)
                    }).catch(u.noop) : K(v.schedule), l.preloadAds && 1 === w) {
                    var i = r.autostart;
                    !1 === i || i === de && 0 === d.getViewable() ? v.loadPreRoll({
                        adBlock: T,
                        preload: !0
                    }).catch(u.noop) : d.once(oe, function() {
                        v.loadPreRoll({
                            adBlock: T,
                            preload: !0
                        }).catch(u.noop)
                    })
                }
            },
            playlistComplete: D,
            complete: function() {
                U(), f = !1
            },
            destroyPlugin: D
        }, this), d.pauseAd = function(e, t) {
            if (e = "boolean" != typeof e || e, g.length) {
                var i = g[g.length - 1];
                e ? i.pause(t || {}) : i.play(t || {})
            }
        }, d.playAd = function(e) {
            U();
            var t = void 0,
                i = 0 === m.requestTimeout ? 1 / 0 : m.requestTimeout,
                r = 0 === m.creativeTimeout ? 1 / 0 : m.creativeTimeout;
            t = Array.isArray(e) ? e.slice(0) : [e];
            var n, a = {
                _id: Ee(12),
                _adQueue: t,
                _waterfallIndex: 0,
                _offset: 0,
                _position: (n = d, n.isBeforePlay() || 0 === n.getPosition() && "idle" === n.getState() ? "pre" : n.isBeforeComplete() || n.getPosition() === n.getDuration() ? "post" : "mid"),
                requestTimeout: i || re,
                creativeTimeout: r || ne
            };
            v ? V(a) : d.once("playlistItem", function() {
                return V(a)
            })
        };
        var G, Y, Z, ee = (G = u, Z = l, yi[Y = e] || (yi[Y] = new Promise(function(n, a) {
            ! function(t) {
                var e = new G.key(Y),
                    s = 'unlimited';
                if ("unlimited" === s) return t();
                var i = ["//", "entitlements.jwplayer.com", "/", e.token(), ".json"];
                "file:" === window.location.protocol && i.unshift("https:"), G.ajax(i.join(""), function(e) {
                    t(e && e.response)
                }, function() {
                    t()
                }, {
                    timeout: 1e4,
                    responseType: "json"
                })
            }(function(e) {
                var t = e || {},
                    i = void 0,
                    r = void 0;
                !0 === Z.outstream ? (i = !1 !== t.canPlayOutstreamAds, r = "Outstream Ad Limit Reached") : (i = !1 !== t.canPlayAds, r = "Ad Limit Reached"), !1 !== i ? n({
                    message: "Can Play Ads"
                }) : a({
                    message: r
                })
            })
        })));
        ee.catch(u.noop), this.destroy = D
    })
}();
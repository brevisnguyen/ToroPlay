/*!
   JW Player version 8.8.5
   Copyright (c) 2019, JW Player, All Rights Reserved 
   This source code and its use and distribution is subject to the terms 
   and conditions of the applicable license agreement. 
   https://www.jwplayer.com/tos/
   This product includes portions of other software. For the full text of licenses, see
   https://ssl.p.jwpcdn.com/player/v/8.8.5/notice.txt
*/
(window.webpackJsonpjwplayer = window.webpackJsonpjwplayer || []).push([
    [4, 1, 2, 3, 14], Array(20).concat([function(e, t, i) {
        "use strict";
        i.r(t);
        var n = {};
        i.r(n), i.d(n, "facebook", function() {
            return Xt
        }), i.d(n, "twitter", function() {
            return Jt
        }), i.d(n, "googleplus", function() {
            return Gt
        }), i.d(n, "linkedin", function() {
            return $t
        }), i.d(n, "pinterest", function() {
            return ei
        }), i.d(n, "reddit", function() {
            return ti
        }), i.d(n, "tumblr", function() {
            return ii
        }), i.d(n, "email", function() {
            return ni
        }), i.d(n, "link", function() {
            return oi
        }), i.d(n, "embed", function() {
            return ai
        });
        var o = i(6),
            a = i(3),
            r = i(8),
            s = i(51),
            l = i(9),
            c = i(17),
            u = i(35),
            d = i(63),
            p = function(e, t, i, n) {
                var o = document.createElement("div");
                o.className = "jw-icon jw-icon-inline jw-button-color jw-reset " + e, o.setAttribute("role", "button"), o.setAttribute("tabindex", "0"), i && o.setAttribute("aria-label", i), o.style.display = "none";
                var a = new u.a(o).on("click tap enter", t || function() {});
                return n && Array.prototype.forEach.call(n, function(e) {
                    "string" == typeof e ? o.appendChild(Object(d.a)(e)) : o.appendChild(e)
                }), {
                    ui: a,
                    element: function() {
                        return o
                    },
                    toggle: function(e) {
                        e ? this.show() : this.hide()
                    },
                    show: function() {
                        o.style.display = ""
                    },
                    hide: function() {
                        o.style.display = "none"
                    }
                }
            },
            f = i(0),
            h = i(61),
            w = i(23);

        function g(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
            }
        }
        var j = {};
        var b = function() {
                function e(t, i, n, o, a) {
                    ! function(e, t) {
                        if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                    }(this, e);
                    var r, s = document.createElement("div");
                    s.className = "jw-icon jw-icon-inline jw-button-color jw-reset ".concat(a || ""), s.setAttribute("button", o), s.setAttribute("role", "button"), s.setAttribute("tabindex", "0"), i && s.setAttribute("aria-label", i), t && "<svg" === t.substring(0, 4) ? r = function(e) {
                        if (!j[e]) {
                            var t = Object.keys(j);
                            t.length > 10 && delete j[t[0]];
                            var i = Object(d.a)(e);
                            j[e] = i
                        }
                        return j[e].cloneNode(!0)
                    }(t) : ((r = document.createElement("div")).className = "jw-icon jw-button-image jw-button-color jw-reset", t && Object(w.d)(r, {
                        backgroundImage: "url(".concat(t, ")")
                    })), s.appendChild(r), new u.a(s).on("click tap enter", n, this), s.addEventListener("mousedown", function(e) {
                        e.preventDefault()
                    }), this.id = o, this.buttonElement = s
                }
                var t, i, n;
                return t = e, (i = [{
                    key: "element",
                    value: function() {
                        return this.buttonElement
                    }
                }, {
                    key: "toggle",
                    value: function(e) {
                        e ? this.show() : this.hide()
                    }
                }, {
                    key: "show",
                    value: function() {
                        this.buttonElement.style.display = ""
                    }
                }, {
                    key: "hide",
                    value: function() {
                        this.buttonElement.style.display = "none"
                    }
                }]) && g(t.prototype, i), n && g(t, n), e
            }(),
            v = i(11);

        function m(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
            }
        }
        var y = function(e) {
                var t = Object(l.c)(e),
                    i = window.pageXOffset;
                return i && o.OS.android && document.body.parentElement.getBoundingClientRect().left >= 0 && (t.left -= i, t.right -= i), t
            },
            k = function() {
                function e(t, i) {
                    ! function(e, t) {
                        if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                    }(this, e), Object(f.j)(this, r.a), this.className = t + " jw-background-color jw-reset", this.orientation = i
                }
                var t, i, n;
                return t = e, (i = [{
                    key: "setup",
                    value: function() {
                        this.el = Object(l.e)(function() {
                            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "",
                                t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "";
                            return '<div class="'.concat(e, " ").concat(t, ' jw-reset" aria-hidden="true">') + '<div class="jw-slider-container jw-reset"><div class="jw-rail jw-reset"></div><div class="jw-buffer jw-reset"></div><div class="jw-progress jw-reset"></div><div class="jw-knob jw-reset"></div></div></div>'
                        }(this.className, "jw-slider-" + this.orientation)), this.elementRail = this.el.getElementsByClassName("jw-slider-container")[0], this.elementBuffer = this.el.getElementsByClassName("jw-buffer")[0], this.elementProgress = this.el.getElementsByClassName("jw-progress")[0], this.elementThumb = this.el.getElementsByClassName("jw-knob")[0], this.ui = new u.a(this.element(), {
                            preventScrolling: !0
                        }).on("dragStart", this.dragStart, this).on("drag", this.dragMove, this).on("dragEnd", this.dragEnd, this).on("click tap", this.tap, this)
                    }
                }, {
                    key: "dragStart",
                    value: function() {
                        this.trigger("dragStart"), this.railBounds = y(this.elementRail)
                    }
                }, {
                    key: "dragEnd",
                    value: function(e) {
                        this.dragMove(e), this.trigger("dragEnd")
                    }
                }, {
                    key: "dragMove",
                    value: function(e) {
                        var t, i, n = this.railBounds = this.railBounds ? this.railBounds : y(this.elementRail);
                        return i = "horizontal" === this.orientation ? (t = e.pageX) < n.left ? 0 : t > n.right ? 100 : 100 * Object(s.a)((t - n.left) / n.width, 0, 1) : (t = e.pageY) >= n.bottom ? 0 : t <= n.top ? 100 : 100 * Object(s.a)((n.height - (t - n.top)) / n.height, 0, 1), this.render(i), this.update(i), !1
                    }
                }, {
                    key: "tap",
                    value: function(e) {
                        this.railBounds = y(this.elementRail), this.dragMove(e)
                    }
                }, {
                    key: "limit",
                    value: function(e) {
                        return e
                    }
                }, {
                    key: "update",
                    value: function(e) {
                        this.trigger("update", {
                            percentage: e
                        })
                    }
                }, {
                    key: "render",
                    value: function(e) {
                        e = Math.max(0, Math.min(e, 100)), "horizontal" === this.orientation ? (this.elementThumb.style.left = e + "%", this.elementProgress.style.width = e + "%") : (this.elementThumb.style.bottom = e + "%", this.elementProgress.style.height = e + "%")
                    }
                }, {
                    key: "updateBuffer",
                    value: function(e) {
                        this.elementBuffer.style.width = e + "%"
                    }
                }, {
                    key: "element",
                    value: function() {
                        return this.el
                    }
                }]) && m(t.prototype, i), n && m(t, n), e
            }(),
            x = function(e, t) {
                e && t && (e.setAttribute("aria-label", t), e.setAttribute("role", "button"), e.setAttribute("tabindex", "0"))
            };

        function O(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
            }
        }
        var T = function() {
                function e(t, i, n, o) {
                    var a = this;
                    ! function(e, t) {
                        if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                    }(this, e), Object(f.j)(this, r.a), this.el = document.createElement("div");
                    var s = "jw-icon jw-icon-tooltip " + t + " jw-button-color jw-reset";
                    n || (s += " jw-hidden"), x(this.el, i), this.el.className = s, this.tooltip = document.createElement("div"), this.tooltip.className = "jw-overlay jw-reset", this.openClass = "jw-open", this.componentType = "tooltip", this.el.appendChild(this.tooltip), o && o.length > 0 && Array.prototype.forEach.call(o, function(e) {
                        "string" == typeof e ? a.el.appendChild(Object(d.a)(e)) : a.el.appendChild(e)
                    })
                }
                var t, i, n;
                return t = e, (i = [{
                    key: "addContent",
                    value: function(e) {
                        this.content && this.removeContent(), this.content = e, this.tooltip.appendChild(e)
                    }
                }, {
                    key: "removeContent",
                    value: function() {
                        this.content && (this.tooltip.removeChild(this.content), this.content = null)
                    }
                }, {
                    key: "hasContent",
                    value: function() {
                        return !!this.content
                    }
                }, {
                    key: "element",
                    value: function() {
                        return this.el
                    }
                }, {
                    key: "openTooltip",
                    value: function(e) {
                        this.isOpen || (this.trigger("open-" + this.componentType, e, {
                            isOpen: !0
                        }), this.isOpen = !0, Object(l.u)(this.el, this.openClass, this.isOpen))
                    }
                }, {
                    key: "closeTooltip",
                    value: function(e) {
                        this.isOpen && (this.trigger("close-" + this.componentType, e, {
                            isOpen: !1
                        }), this.isOpen = !1, Object(l.u)(this.el, this.openClass, this.isOpen))
                    }
                }, {
                    key: "toggleOpenState",
                    value: function(e) {
                        this.isOpen ? this.closeTooltip(e) : this.openTooltip(e)
                    }
                }]) && O(t.prototype, i), n && O(t, n), e
            }(),
            C = i(27),
            S = i(62);

        function _(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
            }
        }
        var M = function() {
                function e(t, i) {
                    ! function(e, t) {
                        if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                    }(this, e), this.time = t, this.text = i, this.el = document.createElement("div"), this.el.className = "jw-cue jw-reset"
                }
                var t, i, n;
                return t = e, (i = [{
                    key: "align",
                    value: function(e) {
                        if ("%" === this.time.toString().slice(-1)) this.pct = this.time;
                        else {
                            var t = this.time / e * 100;
                            this.pct = t + "%"
                        }
                        this.el.style.left = this.pct
                    }
                }]) && _(t.prototype, i), n && _(t, n), e
            }(),
            E = {
                loadChapters: function(e) {
                    Object(C.a)(e, this.chaptersLoaded.bind(this), this.chaptersFailed, {
                        plainText: !0
                    })
                },
                chaptersLoaded: function(e) {
                    var t = Object(S.a)(e.responseText);
                    if (Array.isArray(t)) {
                        var i = this._model.get("cues").concat(t);
                        this._model.set("cues", i)
                    }
                },
                chaptersFailed: function() {},
                addCue: function(e) {
                    this.cues.push(new M(e.begin, e.text))
                },
                drawCues: function() {
                    var e = this,
                        t = this._model.get("duration");
                    !t || t <= 0 || this.cues.forEach(function(i) {
                        i.align(t), i.el.addEventListener("mouseover", function() {
                            e.activeCue = i
                        }), i.el.addEventListener("mouseout", function() {
                            e.activeCue = null
                        }), e.elementRail.appendChild(i.el)
                    })
                },
                resetCues: function() {
                    this.cues.forEach(function(e) {
                        e.el.parentNode && e.el.parentNode.removeChild(e.el)
                    }), this.cues = []
                }
            };

        function A(e) {
            this.begin = e.begin, this.end = e.end, this.img = e.text
        }
        var L = {
            loadThumbnails: function(e) {
                e && (this.vttPath = e.split("?")[0].split("/").slice(0, -1).join("/"), this.individualImage = null, Object(C.a)(e, this.thumbnailsLoaded.bind(this), this.thumbnailsFailed.bind(this), {
                    plainText: !0
                }))
            },
            thumbnailsLoaded: function(e) {
                var t = Object(S.a)(e.responseText);
                Array.isArray(t) && (t.forEach(function(e) {
                    this.thumbnails.push(new A(e))
                }, this), this.drawCues())
            },
            thumbnailsFailed: function() {},
            chooseThumbnail: function(e) {
                var t = Object(f.H)(this.thumbnails, {
                    end: e
                }, Object(f.E)("end"));
                t >= this.thumbnails.length && (t = this.thumbnails.length - 1);
                var i = this.thumbnails[t].img;
                return i.indexOf("://") < 0 && (i = this.vttPath ? this.vttPath + "/" + i : i), i
            },
            loadThumbnail: function(e) {
                var t = this.chooseThumbnail(e),
                    i = {
                        margin: "0 auto",
                        backgroundPosition: "0 0"
                    };
                if (t.indexOf("#xywh") > 0) try {
                    var n = /(.+)#xywh=(\d+),(\d+),(\d+),(\d+)/.exec(t);
                    t = n[1], i.backgroundPosition = -1 * n[2] + "px " + -1 * n[3] + "px", i.width = n[4], this.timeTip.setWidth(+i.width), i.height = n[5]
                } catch (e) {
                    return
                } else this.individualImage || (this.individualImage = new Image, this.individualImage.onload = Object(f.c)(function() {
                    this.individualImage.onload = null, this.timeTip.image({
                        width: this.individualImage.width,
                        height: this.individualImage.height
                    }), this.timeTip.setWidth(this.individualImage.width)
                }, this), this.individualImage.src = t);
                return i.backgroundImage = 'url("' + t + '")', i
            },
            showThumbnail: function(e) {
                this._model.get("containerWidth") <= 420 || this.thumbnails.length < 1 || this.timeTip.image(this.loadThumbnail(e))
            },
            resetThumbnails: function() {
                this.timeTip.image({
                    backgroundImage: "",
                    width: 0,
                    height: 0
                }), this.thumbnails = []
            }
        };

        function z(e, t, i) {
            return (z = "undefined" != typeof Reflect && Reflect.get ? Reflect.get : function(e, t, i) {
                var n = function(e, t) {
                    for (; !Object.prototype.hasOwnProperty.call(e, t) && null !== (e = V(e)););
                    return e
                }(e, t);
                if (n) {
                    var o = Object.getOwnPropertyDescriptor(n, t);
                    return o.get ? o.get.call(i) : o.value
                }
            })(e, t, i || e)
        }

        function P(e) {
            return (P = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            } : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            })(e)
        }

        function I(e, t) {
            if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
        }

        function R(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
            }
        }

        function B(e, t, i) {
            return t && R(e.prototype, t), i && R(e, i), e
        }

        function H(e, t) {
            return !t || "object" !== P(t) && "function" != typeof t ? function(e) {
                if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                return e
            }(e) : t
        }

        function V(e) {
            return (V = Object.setPrototypeOf ? Object.getPrototypeOf : function(e) {
                return e.__proto__ || Object.getPrototypeOf(e)
            })(e)
        }

        function N(e, t) {
            if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function");
            e.prototype = Object.create(t && t.prototype, {
                constructor: {
                    value: e,
                    writable: !0,
                    configurable: !0
                }
            }), t && q(e, t)
        }

        function q(e, t) {
            return (q = Object.setPrototypeOf || function(e, t) {
                return e.__proto__ = t, e
            })(e, t)
        }
        var F = function(e) {
            function t() {
                return I(this, t), H(this, V(t).apply(this, arguments))
            }
            return N(t, T), B(t, [{
                key: "setup",
                value: function() {
                    this.text = document.createElement("span"), this.text.className = "jw-text jw-reset", this.img = document.createElement("div"), this.img.className = "jw-time-thumb jw-reset", this.containerWidth = 0, this.textLength = 0, this.dragJustReleased = !1;
                    var e = document.createElement("div");
                    e.className = "jw-time-tip jw-reset", e.appendChild(this.img), e.appendChild(this.text), this.addContent(e)
                }
            }, {
                key: "image",
                value: function(e) {
                    Object(w.d)(this.img, e)
                }
            }, {
                key: "update",
                value: function(e) {
                    this.text.textContent = e
                }
            }, {
                key: "getWidth",
                value: function() {
                    return this.containerWidth || this.setWidth(), this.containerWidth
                }
            }, {
                key: "setWidth",
                value: function(e) {
                    e ? this.containerWidth = e + 16 : this.tooltip && (this.containerWidth = Object(l.c)(this.container).width + 16)
                }
            }, {
                key: "resetWidth",
                value: function() {
                    this.containerWidth = 0
                }
            }]), t
        }();
        var D = function(e) {
            function t(e, i, n) {
                var o;
                return I(this, t), (o = H(this, V(t).call(this, "jw-slider-time", "horizontal")))._model = e, o._api = i, o.timeUpdateKeeper = n, o.timeTip = new F("jw-tooltip-time", null, !0), o.timeTip.setup(), o.cues = [], o.seekThrottled = Object(f.I)(o.performSeek, 400), o.mobileHoverDistance = 5, o.setup(), o
            }
            return N(t, k), B(t, [{
                key: "setup",
                value: function() {
                    var e = this;
                    z(V(t.prototype), "setup", this).apply(this, arguments), this._model.on("change:duration", this.onDuration, this).on("change:cues", this.updateCues, this).on("seeked", function() {
                        e._model.get("scrubbing") || e.updateAriaText()
                    }).change("position", this.onPosition, this).change("buffer", this.onBuffer, this).change("streamType", this.onStreamType, this), this._model.player.change("playlistItem", this.onPlaylistItem, this);
                    var i = this.el;
                    Object(l.s)(i, "tabindex", "0"), Object(l.s)(i, "role", "slider"), Object(l.s)(i, "aria-label", this._model.get("localization").slider), i.removeAttribute("aria-hidden"), this.elementRail.appendChild(this.timeTip.element()), this.ui = (this.ui || new u.a(i)).on("move drag", this.showTimeTooltip, this).on("dragEnd out", this.hideTimeTooltip, this).on("click", function() {
                        return i.focus()
                    }).on("focus", this.updateAriaText, this)
                }
            }, {
                key: "update",
                value: function(e) {
                    this.seekTo = e, this.seekThrottled(), z(V(t.prototype), "update", this).apply(this, arguments)
                }
            }, {
                key: "dragStart",
                value: function() {
                    this._model.set("scrubbing", !0), z(V(t.prototype), "dragStart", this).apply(this, arguments)
                }
            }, {
                key: "dragEnd",
                value: function() {
                    z(V(t.prototype), "dragEnd", this).apply(this, arguments), this._model.set("scrubbing", !1)
                }
            }, {
                key: "onBuffer",
                value: function(e, t) {
                    this.updateBuffer(t)
                }
            }, {
                key: "onPosition",
                value: function(e, t) {
                    this.updateTime(t, e.get("duration"))
                }
            }, {
                key: "onDuration",
                value: function(e, t) {
                    this.updateTime(e.get("position"), t), Object(l.s)(this.el, "aria-valuemin", 0), Object(l.s)(this.el, "aria-valuemax", t), this.drawCues()
                }
            }, {
                key: "onStreamType",
                value: function(e, t) {
                    this.streamType = t
                }
            }, {
                key: "updateTime",
                value: function(e, t) {
                    var i = 0;
                    if (t)
                        if ("DVR" === this.streamType) {
                            var n = this._model.get("dvrSeekLimit"),
                                o = t + n;
                            i = (o - (e + n)) / o * 100
                        } else "VOD" !== this.streamType && this.streamType || (i = e / t * 100);
                    this.render(i)
                }
            }, {
                key: "onPlaylistItem",
                value: function(e, t) {
                    this.reset();
                    var i = t.tracks;
                    Object(f.i)(i, function(e) {
                        e && e.kind && "thumbnails" === e.kind.toLowerCase() ? this.loadThumbnails(e.file) : e && e.kind && "chapters" === e.kind.toLowerCase() && this.loadChapters(e.file)
                    }, this)
                }
            }, {
                key: "performSeek",
                value: function() {
                    var e, t = this.seekTo,
                        i = this._model.get("duration");
                    if (0 === i) this._api.play({
                        reason: "interaction"
                    });
                    else if ("DVR" === this.streamType) {
                        var n = this._model.get("seekRange") || {
                                start: 0
                            },
                            o = this._model.get("dvrSeekLimit");
                        e = n.start + (-i - o) * t / 100, this._api.seek(e, {
                            reason: "interaction"
                        })
                    } else e = t / 100 * i, this._api.seek(Math.min(e, i - .25), {
                        reason: "interaction"
                    })
                }
            }, {
                key: "showTimeTooltip",
                value: function(e) {
                    var t = this,
                        i = this._model.get("duration");
                    if (0 !== i) {
                        var n, o = this._model.get("containerWidth"),
                            a = Object(l.c)(this.elementRail),
                            r = e.pageX ? e.pageX - a.left : e.x,
                            c = (r = Object(s.a)(r, 0, a.width)) / a.width,
                            u = i * c;
                        if (i < 0) u = (i += this._model.get("dvrSeekLimit")) - (u = i * c);
                        if ("touch" === e.pointerType && (this.activeCue = this.cues.reduce(function(e, i) {
                                return Math.abs(r - parseInt(i.pct) / 100 * a.width) < t.mobileHoverDistance ? i : e
                            }, void 0)), this.activeCue) n = this.activeCue.text;
                        else {
                            n = Object(v.timeFormat)(u, !0), i < 0 && u > -1 && (n = "Live")
                        }
                        var d = this.timeTip;
                        d.update(n), this.textLength !== n.length && (this.textLength = n.length, d.resetWidth()), this.showThumbnail(u), Object(l.a)(d.el, "jw-open");
                        var p = d.getWidth(),
                            f = a.width / 100,
                            h = o - a.width,
                            g = 0;
                        p > h && (g = (p - h) / (200 * f));
                        var j = 100 * Math.min(1 - g, Math.max(g, c)).toFixed(3);
                        Object(w.d)(d.el, {
                            left: j + "%"
                        })
                    }
                }
            }, {
                key: "hideTimeTooltip",
                value: function() {
                    Object(l.n)(this.timeTip.el, "jw-open")
                }
            }, {
                key: "updateCues",
                value: function(e, t) {
                    var i = this;
                    this.resetCues(), t && t.length && (t.forEach(function(e) {
                        i.addCue(e)
                    }), this.drawCues())
                }
            }, {
                key: "updateAriaText",
                value: function() {
                    var e = this._model;
                    if (!e.get("seeking")) {
                        var t = e.get("position"),
                            i = e.get("duration"),
                            n = Object(v.timeFormat)(t);
                        "DVR" !== this.streamType && (n += " of ".concat(Object(v.timeFormat)(i)));
                        var o = this.el;
                        document.activeElement !== o && (this.timeUpdateKeeper.textContent = n), Object(l.s)(o, "aria-valuenow", t), Object(l.s)(o, "aria-valuetext", n)
                    }
                }
            }, {
                key: "reset",
                value: function() {
                    this.resetThumbnails(), this.timeTip.resetWidth(), this.textLength = 0
                }
            }]), t
        }();
        Object(f.j)(D.prototype, E, L);
        var U = D;

        function W(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
            }
        }

        function Z(e, t, i) {
            return (Z = "undefined" != typeof Reflect && Reflect.get ? Reflect.get : function(e, t, i) {
                var n = function(e, t) {
                    for (; !Object.prototype.hasOwnProperty.call(e, t) && null !== (e = J(e)););
                    return e
                }(e, t);
                if (n) {
                    var o = Object.getOwnPropertyDescriptor(n, t);
                    return o.get ? o.get.call(i) : o.value
                }
            })(e, t, i || e)
        }

        function Q(e) {
            return (Q = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            } : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            })(e)
        }

        function Y(e, t) {
            if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
        }

        function K(e, t) {
            return !t || "object" !== Q(t) && "function" != typeof t ? X(e) : t
        }

        function X(e) {
            if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
            return e
        }

        function J(e) {
            return (J = Object.setPrototypeOf ? Object.getPrototypeOf : function(e) {
                return e.__proto__ || Object.getPrototypeOf(e)
            })(e)
        }

        function G(e, t) {
            if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function");
            e.prototype = Object.create(t && t.prototype, {
                constructor: {
                    value: e,
                    writable: !0,
                    configurable: !0
                }
            }), t && $(e, t)
        }

        function $(e, t) {
            return ($ = Object.setPrototypeOf || function(e, t) {
                return e.__proto__ = t, e
            })(e, t)
        }
        var ee = function(e) {
                function t(e, i, n) {
                    var o;
                    Y(this, t);
                    var a = "jw-slider-volume";
                    return "vertical" === e && (a += " jw-volume-tip"), (o = K(this, J(t).call(this, a, e))).setup(), o.element().classList.remove("jw-background-color"), Object(l.s)(n, "tabindex", "0"), Object(l.s)(n, "aria-label", i), Object(l.s)(n, "aria-orientation", e), Object(l.s)(n, "aria-valuemin", 0), Object(l.s)(n, "aria-valuemax", 100), Object(l.s)(n, "role", "slider"), o.uiOver = new u.a(n).on("click", function() {}), o
                }
                return G(t, k), t
            }(),
            te = function(e) {
                function t(e, i, n, o, a) {
                    var r;
                    Y(this, t), (r = K(this, J(t).call(this, i, n, !0, o)))._model = e, r.horizontalContainer = a;
                    var s = e.get("localization").volumeSlider;
                    return r.horizontalSlider = new ee("horizontal", s, a, X(X(r))), r.verticalSlider = new ee("vertical", s, r.tooltip, X(X(r))), a.appendChild(r.horizontalSlider.element()), r.addContent(r.verticalSlider.element()), r.verticalSlider.on("update", function(e) {
                        this.trigger("update", e)
                    }, X(X(r))), r.horizontalSlider.on("update", function(e) {
                        this.trigger("update", e)
                    }, X(X(r))), r.horizontalSlider.uiOver.on("keydown", function(e) {
                        var t = e.sourceEvent;
                        switch (t.keyCode) {
                            case 37:
                                t.stopPropagation(), r.trigger("adjustVolume", -10);
                                break;
                            case 39:
                                t.stopPropagation(), r.trigger("adjustVolume", 10)
                        }
                    }), r.ui = new u.a(r.el, {
                        directSelect: !0
                    }).on("click enter", r.toggleValue, X(X(r))).on("tap", r.toggleOpenState, X(X(r))), r.addSliderHandlers(r.ui), r.addSliderHandlers(r.horizontalSlider.uiOver), r.addSliderHandlers(r.verticalSlider.uiOver), r.onAudioMode(null, e.get("audioMode")), r._model.on("change:audioMode", r.onAudioMode, X(X(r))), r._model.on("change:volume", r.onVolume, X(X(r))), r
                }
                var i, n, o;
                return G(t, T), i = t, (n = [{
                    key: "onAudioMode",
                    value: function(e, t) {
                        var i = t ? 0 : -1;
                        Object(l.s)(this.horizontalContainer, "tabindex", i)
                    }
                }, {
                    key: "addSliderHandlers",
                    value: function(e) {
                        var t = this.openSlider,
                            i = this.closeSlider;
                        e.on("over", t, this).on("out", i, this).on("focus", t, this).on("blur", i, this)
                    }
                }, {
                    key: "openSlider",
                    value: function(e) {
                        Z(J(t.prototype), "openTooltip", this).call(this, e), Object(l.u)(this.horizontalContainer, this.openClass, !0)
                    }
                }, {
                    key: "closeSlider",
                    value: function(e) {
                        Z(J(t.prototype), "closeTooltip", this).call(this, e), Object(l.u)(this.horizontalContainer, this.openClass, !1), this.horizontalContainer.blur()
                    }
                }, {
                    key: "toggleValue",
                    value: function() {
                        this.trigger("toggleValue")
                    }
                }, {
                    key: "destroy",
                    value: function() {
                        this.horizontalSlider.uiOver.destroy(), this.verticalSlider.uiOver.destroy(), this.ui.destroy()
                    }
                }]) && W(i.prototype, n), o && W(i, o), t
            }();

        function ie(e, t, i, n, o) {
            var a = document.createElement("div");
            a.className = "jw-reset-text jw-tooltip jw-tooltip-".concat(t), a.setAttribute("dir", "auto");
            var r = document.createElement("div");
            r.className = "jw-text", a.appendChild(r), e.appendChild(a);
            var s = {
                    dirty: !!i,
                    opened: !1,
                    text: i,
                    open: function() {
                        s.touchEvent || (c(!0), n && n())
                    },
                    close: function() {
                        s.touchEvent || (c(!1), o && o())
                    },
                    setText: function(e) {
                        e !== s.text && (s.text = e, s.dirty = !0), s.opened && c(!0)
                    }
                },
                c = function(e) {
                    e && s.dirty && (Object(l.p)(r, s.text), s.dirty = !1), s.opened = e, Object(l.u)(a, "jw-open", e)
                };
            return e.addEventListener("mouseover", s.open), e.addEventListener("focus", s.open), e.addEventListener("blur", s.close), e.addEventListener("mouseout", s.close), e.addEventListener("touchstart", function() {
                s.touchEvent = !0
            }, {
                passive: !0
            }), s
        }
        var ne = i(65);

        function oe(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
            }
        }

        function ae(e, t) {
            var i = document.createElement("div");
            return i.className = "jw-icon jw-icon-inline jw-text jw-reset " + e, t && Object(l.s)(i, "role", t), i
        }

        function re(e) {
            var t = document.createElement("div");
            return t.className = "jw-reset ".concat(e), t
        }

        function se(e, t) {
            if (o.Browser.safari) {
                var i = p("jw-icon-airplay jw-off", e, t.airplay, Object(h.b)("airplay-off,airplay-on"));
                return ie(i.element(), "airplay", t.airplay), i
            }
            if (o.Browser.chrome && !o.OS.iOS) {
                var n = document.createElement("google-cast-launcher");
                Object(l.s)(n, "tabindex", "-1"), n.className += " jw-reset";
                var a = document.createElement("div");
                return a.className = "jw-reset jw-icon jw-icon-inline jw-icon-cast jw-button-color", a.style.display = "none", a.style.cursor = "pointer", a.appendChild(n), x(a, t.cast), ie(a, "chromecast", t.cast), {
                    element: function() {
                        return a
                    },
                    toggle: function(e) {
                        e ? this.show() : this.hide()
                    },
                    show: function() {
                        a.style.display = ""
                    },
                    hide: function() {
                        a.style.display = "none"
                    },
                    button: n
                }
            }
        }

        function le(e, t) {
            return e.filter(function(e) {
                return !t.some(function(t) {
                    return t.id + t.btnClass === e.id + e.btnClass && e.callback === t.callback
                })
            })
        }
        var ce = function(e, t) {
                t.forEach(function(t) {
                    t.element && (t = t.element()), e.appendChild(t)
                })
            },
            ue = function() {
                function e(t, i, n) {
                    var s = this;
                    ! function(e, t) {
                        if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                    }(this, e), Object(f.j)(this, r.a), this._api = t, this._model = i, this._isMobile = o.OS.mobile, this._volumeAnnouncer = n.querySelector(".jw-volume-update");
                    var c, d, w, g = i.get("localization"),
                        j = new U(i, t, n.querySelector(".jw-time-update")),
                        b = this.menus = [];
                    this.ui = [];
                    var v = "",
                        m = g.volume;
                    if (this._isMobile) {
                        if (!(i.get("sdkplatform") || o.OS.iOS && o.OS.version.major < 10)) {
                            var y = Object(h.b)("volume-0,volume-100");
                            w = p("jw-icon-volume", function() {
                                t.setMute()
                            }, m, y)
                        }
                    } else {
                        (d = document.createElement("div")).className = "jw-horizontal-volume-container";
                        var k = (c = new te(i, "jw-icon-volume", m, Object(h.b)("volume-0,volume-50,volume-100"), d)).element();
                        b.push(c), Object(l.s)(k, "role", "button"), i.change("mute", function(e, t) {
                            var i = t ? g.unmute : g.mute;
                            Object(l.s)(k, "aria-label", i)
                        }, this)
                    }
                    var x = p("jw-icon-next", function() {
                            t.next({
                                feedShownId: v,
                                reason: "interaction"
                            })
                        }, g.next, Object(h.b)("next")),
                        O = p("jw-icon-settings jw-settings-submenu-button", function(e) {
                            s.trigger("settingsInteraction", "quality", !0, e)
                        }, g.settings, Object(h.b)("settings"));
                    Object(l.s)(O.element(), "aria-haspopup", "true");
                    var T = p("jw-icon-cc jw-settings-submenu-button", function(e) {
                        s.trigger("settingsInteraction", "captions", !1, e)
                    }, g.cc, Object(h.b)("cc-off,cc-on"));
                    Object(l.s)(T.element(), "aria-haspopup", "true");
                    var C = p("jw-text-live", function() {
                        s.goToLiveEdge()
                    }, g.liveBroadcast);
                    C.element().textContent = g.liveBroadcast;
                    var S, _, M, E = this.elements = {
                            alt: (S = "jw-text-alt", _ = "status", M = document.createElement("span"), M.className = "jw-text jw-reset " + S, _ && Object(l.s)(M, "role", _), M),
                            play: p("jw-icon-playback", function() {
                                t.playToggle({
                                    reason: "interaction"
                                })
                            }, g.play, Object(h.b)("play,pause,stop")),
                            rewind: p("jw-icon-rewind", function() {
                                s.rewind()
                            }, g.rewind, Object(h.b)("rewind")),
                            live: C,
                            next: x,
                            elapsed: ae("jw-text-elapsed", "timer"),
                            countdown: ae("jw-text-countdown", "timer"),
                            time: j,
                            duration: ae("jw-text-duration", "timer"),
                            mute: w,
                            volumetooltip: c,
                            horizontalVolumeContainer: d,
                            cast: se(function() {
                                t.castToggle()
                            }, g),
                            fullscreen: p("jw-icon-fullscreen", function() {
                                t.setFullscreen()
                            }, g.fullscreen, Object(h.b)("fullscreen-off,fullscreen-on")),
                            spacer: re("jw-spacer"),
                            buttonContainer: re("jw-button-container"),
                            settingsButton: O,
                            captionsButton: T
                        },
                        A = ie(T.element(), "captions", g.cc),
                        L = function(e) {
                            var t = e.get("captionsList")[e.get("captionsIndex")],
                                i = g.cc;
                            t && "Off" !== t.label && (i = t.label), A.setText(i)
                        },
                        z = ie(E.play.element(), "play", g.play);
                    this.setPlayText = function(e) {
                        z.setText(e)
                    };
                    var P = E.next.element(),
                        I = ie(P, "next", g.nextUp, function() {
                            var e = i.get("nextUp");
                            v = Object(ne.b)(ne.a), s.trigger("nextShown", {
                                mode: e.mode,
                                ui: "nextup",
                                itemsShown: [e],
                                feedData: e.feedData,
                                reason: "hover",
                                feedShownId: v
                            })
                        }, function() {
                            v = ""
                        });
                    Object(l.s)(P, "dir", "auto"), ie(E.rewind.element(), "rewind", g.rewind), ie(E.settingsButton.element(), "settings", g.settings);
                    var R = ie(E.fullscreen.element(), "fullscreen", g.fullscreen),
                        B = [E.play, E.rewind, E.next, E.volumetooltip, E.mute, E.horizontalVolumeContainer, E.alt, E.live, E.elapsed, E.countdown, E.duration, E.spacer, E.cast, E.captionsButton, E.settingsButton, E.fullscreen].filter(function(e) {
                            return e
                        }),
                        H = [E.time, E.buttonContainer].filter(function(e) {
                            return e
                        });
                    this.el = document.createElement("div"), this.el.className = "jw-controlbar jw-reset", ce(E.buttonContainer, B), ce(this.el, H);
                    var V = i.get("logo");
                    if (V && "control-bar" === V.position && this.addLogo(V), E.play.show(), E.fullscreen.show(), E.mute && E.mute.show(), i.change("volume", this.onVolume, this), i.change("mute", function(e, t) {
                            s.renderVolume(t, e.get("volume"))
                        }, this), i.change("state", this.onState, this), i.change("duration", this.onDuration, this), i.change("position", this.onElapsed, this), i.change("fullscreen", function(e, t) {
                            var i = s.elements.fullscreen.element();
                            Object(l.u)(i, "jw-off", t);
                            var n = e.get("fullscreen") ? g.exitFullscreen : g.fullscreen;
                            R.setText(n), Object(l.s)(i, "aria-label", n)
                        }, this), i.change("streamType", this.onStreamTypeChange, this), i.change("dvrLive", function(e, t) {
                            var i = g.liveBroadcast,
                                n = g.notLive,
                                o = s.elements.live.element(),
                                a = !1 === t;
                            Object(l.u)(o, "jw-dvr-live", a), Object(l.s)(o, "aria-label", a ? n : i), o.textContent = i
                        }, this), i.change("altText", this.setAltText, this), i.change("customButtons", this.updateButtons, this), i.on("change:captionsIndex", L, this), i.on("change:captionsList", L, this), i.change("nextUp", function(e, t) {
                            v = Object(ne.b)(ne.a);
                            var i = g.nextUp;
                            t && t.title && (i += ": ".concat(t.title)), I.setText(i), E.next.toggle(!!t)
                        }, this), i.change("audioMode", this.onAudioMode, this), E.cast && (i.change("castAvailable", this.onCastAvailable, this), i.change("castActive", this.onCastActive, this)), E.volumetooltip && (E.volumetooltip.on("update", function(e) {
                            var t = e.percentage;
                            this._api.setVolume(t)
                        }, this), E.volumetooltip.on("toggleValue", function() {
                            this._api.setMute()
                        }, this), E.volumetooltip.on("adjustVolume", function(e) {
                            this.trigger("adjustVolume", e)
                        }, this)), E.cast && E.cast.button) {
                        var N = new u.a(E.cast.element()).on("click tap enter", function(e) {
                            "click" !== e.type && E.cast.button.click(), this._model.set("castClicked", !0)
                        }, this);
                        this.ui.push(N)
                    }
                    var q = new u.a(E.duration).on("click tap enter", function() {
                        if ("DVR" === this._model.get("streamType")) {
                            var e = this._model.get("position"),
                                t = this._model.get("dvrSeekLimit");
                            this._api.seek(Math.max(-t, e), {
                                reason: "interaction"
                            })
                        }
                    }, this);
                    this.ui.push(q);
                    var F = new u.a(this.el).on("click tap drag", function() {
                        this.trigger(a.tb)
                    }, this);
                    this.ui.push(F), b.forEach(function(e) {
                        e.on("open-tooltip", s.closeMenus, s)
                    })
                }
                var t, i, n;
                return t = e, (i = [{
                    key: "onVolume",
                    value: function(e, t) {
                        this.renderVolume(e.get("mute"), t)
                    }
                }, {
                    key: "renderVolume",
                    value: function(e, t) {
                        var i = this.elements.mute,
                            n = this.elements.volumetooltip;
                        if (i && (Object(l.u)(i.element(), "jw-off", e), Object(l.u)(i.element(), "jw-full", !e)), n) {
                            var o = e ? 0 : t,
                                a = n.element();
                            n.verticalSlider.render(o), n.horizontalSlider.render(o);
                            var r = n.tooltip,
                                s = n.horizontalContainer;
                            Object(l.u)(a, "jw-off", e), Object(l.u)(a, "jw-full", t >= 75 && !e), Object(l.s)(r, "aria-valuenow", o), Object(l.s)(s, "aria-valuenow", o);
                            var c = "Volume ".concat(o, "%");
                            Object(l.s)(r, "aria-valuetext", c), Object(l.s)(s, "aria-valuetext", c), document.activeElement !== r && document.activeElement !== s && (this._volumeAnnouncer.textContent = c)
                        }
                    }
                }, {
                    key: "onCastAvailable",
                    value: function(e, t) {
                        this.elements.cast.toggle(t)
                    }
                }, {
                    key: "onCastActive",
                    value: function(e, t) {
                        this.elements.fullscreen.toggle(!t), this.elements.cast.button && Object(l.u)(this.elements.cast.button, "jw-off", !t)
                    }
                }, {
                    key: "onElapsed",
                    value: function(e, t) {
                        var i, n, o = e.get("duration");
                        if ("DVR" === e.get("streamType")) {
                            var a = Math.ceil(t),
                                r = this._model.get("dvrSeekLimit");
                            i = n = a >= -r ? "" : "-" + Object(v.timeFormat)(-(t + r)), e.set("dvrLive", a >= -r)
                        } else i = Object(v.timeFormat)(t), n = Object(v.timeFormat)(o - t);
                        this.elements.elapsed.textContent = i, this.elements.countdown.textContent = n
                    }
                }, {
                    key: "onDuration",
                    value: function(e, t) {
                        this.elements.duration.textContent = Object(v.timeFormat)(Math.abs(t))
                    }
                }, {
                    key: "onAudioMode",
                    value: function(e, t) {
                        var i = this.elements.time.element();
                        t ? this.elements.buttonContainer.insertBefore(i, this.elements.elapsed) : Object(l.l)(this.el, i)
                    }
                }, {
                    key: "element",
                    value: function() {
                        return this.el
                    }
                }, {
                    key: "setAltText",
                    value: function(e, t) {
                        this.elements.alt.textContent = t
                    }
                }, {
                    key: "closeMenus",
                    value: function(e) {
                        this.menus.forEach(function(t) {
                            e && e.target === t.el || t.closeTooltip(e)
                        })
                    }
                }, {
                    key: "rewind",
                    value: function() {
                        var e, t = 0,
                            i = this._model.get("currentTime");
                        i ? e = i - 10 : (e = this._model.get("position") - 10, "DVR" === this._model.get("streamType") && (t = this._model.get("duration"))), this._api.seek(Math.max(e, t), {
                            reason: "interaction"
                        })
                    }
                }, {
                    key: "onState",
                    value: function(e, t) {
                        var i = e.get("localization"),
                            n = i.play;
                        this.setPlayText(n), t === a.qb && ("LIVE" !== e.get("streamType") ? (n = i.pause, this.setPlayText(n)) : (n = i.stop, this.setPlayText(n))), Object(l.s)(this.elements.play.element(), "aria-label", n)
                    }
                }, {
                    key: "onStreamTypeChange",
                    value: function(e, t) {
                        var i = "LIVE" === t,
                            n = "DVR" === t;
                        this.elements.rewind.toggle(!i), this.elements.live.toggle(i || n), Object(l.s)(this.elements.live.element(), "tabindex", i ? "-1" : "0"), this.elements.duration.style.display = n ? "none" : "", this.onDuration(e, e.get("duration")), this.onState(e, e.get("state"))
                    }
                }, {
                    key: "addLogo",
                    value: function(e) {
                        var t = this.elements.buttonContainer,
                            i = new b(e.file, this._model.get("localization").logo, function() {
                                e.link && Object(l.k)(e.link, "_blank", {
                                    rel: "noreferrer"
                                })
                            }, "logo", "jw-logo-button");
                        e.link || Object(l.s)(i.element(), "tabindex", "-1"), t.insertBefore(i.element(), t.querySelector(".jw-spacer").nextSibling)
                    }
                }, {
                    key: "goToLiveEdge",
                    value: function() {
                        if ("DVR" === this._model.get("streamType")) {
                            var e = Math.min(this._model.get("position"), -1),
                                t = this._model.get("dvrSeekLimit");
                            this._api.seek(Math.max(-t, e), {
                                reason: "interaction"
                            }), this._api.play({
                                reason: "interaction"
                            })
                        }
                    }
                }, {
                    key: "updateButtons",
                    value: function(e, t, i) {
                        if (t) {
                            var n, o, a = this.elements.buttonContainer;
                            t !== i && i ? (n = le(t, i), o = le(i, t), this.removeButtons(a, o)) : n = t;
                            for (var r = n.length - 1; r >= 0; r--) {
                                var s = n[r],
                                    l = new b(s.img, s.tooltip, s.callback, s.id, s.btnClass);
                                s.tooltip && ie(l.element(), s.id, s.tooltip);
                                var c = void 0;
                                "related" === l.id ? c = this.elements.settingsButton.element() : "share" === l.id ? c = a.querySelector('[button="related"]') || this.elements.settingsButton.element() : (c = this.elements.spacer.nextSibling) && "logo" === c.getAttribute("button") && (c = c.nextSibling), a.insertBefore(l.element(), c)
                            }
                        }
                    }
                }, {
                    key: "removeButtons",
                    value: function(e, t) {
                        for (var i = t.length; i--;) {
                            var n = e.querySelector('[button="'.concat(t[i].id, '"]'));
                            n && e.removeChild(n)
                        }
                    }
                }, {
                    key: "toggleCaptionsButtonState",
                    value: function(e) {
                        var t = this.elements.captionsButton;
                        t && Object(l.u)(t.element(), "jw-off", !e)
                    }
                }, {
                    key: "destroy",
                    value: function() {
                        var e = this;
                        this._model.off(null, null, this), Object.keys(this.elements).forEach(function(t) {
                            var i = e.elements[t];
                            i && "function" == typeof i.destroy && e.elements[t].destroy()
                        }), this.ui.forEach(function(e) {
                            e.destroy()
                        }), this.ui = []
                    }
                }]) && oe(t.prototype, i), n && oe(t, n), e
            }(),
            de = function() {
                var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "",
                    t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "";
                return '<div class="jw-display-icon-container jw-display-icon-'.concat(e, ' jw-reset">') + '<div class="jw-icon jw-icon-'.concat(e, ' jw-button-color jw-reset" role="button" tabindex="0" aria-label="').concat(t, '"></div>') + "</div>"
            },
            pe = function(e) {
                return '<div class="jw-display jw-reset"><div class="jw-display-container jw-reset"><div class="jw-display-controls jw-reset">' + de("rewind", e.rewind) + de("display", e.playback) + de("next", e.next) + "</div></div></div>"
            };

        function fe(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
            }
        }
        var he = function() {
            function e(t, i, n) {
                ! function(e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }(this, e);
                var o = n.querySelector(".jw-icon");
                this.el = n, this.ui = new u.a(o).on("click tap enter", function() {
                    var e = t.get("position"),
                        n = t.get("duration"),
                        o = e - 10,
                        a = 0;
                    "DVR" === t.get("streamType") && (a = n), i.seek(Math.max(o, a))
                })
            }
            var t, i, n;
            return t = e, (i = [{
                key: "element",
                value: function() {
                    return this.el
                }
            }]) && fe(t.prototype, i), n && fe(t, n), e
        }();

        function we(e) {
            return (we = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            } : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            })(e)
        }

        function ge(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
            }
        }

        function je(e, t) {
            return !t || "object" !== we(t) && "function" != typeof t ? function(e) {
                if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                return e
            }(e) : t
        }

        function be(e) {
            return (be = Object.setPrototypeOf ? Object.getPrototypeOf : function(e) {
                return e.__proto__ || Object.getPrototypeOf(e)
            })(e)
        }

        function ve(e, t) {
            return (ve = Object.setPrototypeOf || function(e, t) {
                return e.__proto__ = t, e
            })(e, t)
        }
        var me = function(e) {
            function t(e, i, n) {
                var o;
                ! function(e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }(this, t), o = je(this, be(t).call(this));
                var a = e.get("localization"),
                    r = n.querySelector(".jw-icon");
                if (o.icon = r, o.el = n, o.ui = new u.a(r).on("click tap enter", function(e) {
                        o.trigger(e.type)
                    }), e.on("change:state", function(e, t) {
                        var i;
                        switch (t) {
                            case "buffering":
                                i = a.buffer;
                                break;
                            case "playing":
                                i = a.pause;
                                break;
                            case "idle":
                            case "paused":
                                i = a.playback;
                                break;
                            case "complete":
                                i = a.replay;
                                break;
                            default:
                                i = ""
                        }
                        "" !== i ? r.setAttribute("aria-label", i) : r.removeAttribute("aria-label")
                    }), e.get("displayPlaybackLabel")) {
                    var s = o.icon.getElementsByClassName("jw-idle-icon-text")[0];
                    s || (s = Object(l.e)('<div class="jw-idle-icon-text">'.concat(a.playback, "</div>")), Object(l.a)(o.icon, "jw-idle-label"), o.icon.appendChild(s))
                }
                return o
            }
            var i, n, o;
            return function(e, t) {
                if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function");
                e.prototype = Object.create(t && t.prototype, {
                    constructor: {
                        value: e,
                        writable: !0,
                        configurable: !0
                    }
                }), t && ve(e, t)
            }(t, r["a"]), i = t, (n = [{
                key: "element",
                value: function() {
                    return this.el
                }
            }]) && ge(i.prototype, n), o && ge(i, o), t
        }();

        function ye(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
            }
        }
        var ke = function() {
            function e(t, i, n) {
                ! function(e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }(this, e);
                var o = n.querySelector(".jw-icon");
                this.ui = new u.a(o).on("click tap enter", function() {
                    i.next({
                        reason: "interaction"
                    })
                }), t.change("nextUp", function(e, t) {
                    n.style.visibility = t ? "" : "hidden"
                }), this.el = n
            }
            var t, i, n;
            return t = e, (i = [{
                key: "element",
                value: function() {
                    return this.el
                }
            }]) && ye(t.prototype, i), n && ye(t, n), e
        }();

        function xe(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
            }
        }
        var Oe = function() {
            function e(t, i) {
                ! function(e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }(this, e), this.el = Object(l.e)(pe(t.get("localization")));
                var n = this.el.querySelector(".jw-display-controls"),
                    o = {};
                Te("rewind", Object(h.b)("rewind"), he, n, o, t, i), Te("display", Object(h.b)("play,pause,buffer,replay"), me, n, o, t, i), Te("next", Object(h.b)("next"), ke, n, o, t, i), this.container = n, this.buttons = o
            }
            var t, i, n;
            return t = e, (i = [{
                key: "element",
                value: function() {
                    return this.el
                }
            }, {
                key: "destroy",
                value: function() {
                    var e = this.buttons;
                    Object.keys(e).forEach(function(t) {
                        e[t].ui && e[t].ui.destroy()
                    })
                }
            }]) && xe(t.prototype, i), n && xe(t, n), e
        }();

        function Te(e, t, i, n, o, a, r) {
            var s = n.querySelector(".jw-display-icon-".concat(e)),
                l = n.querySelector(".jw-icon-".concat(e));
            t.forEach(function(e) {
                l.appendChild(e)
            }), o[e] = new i(a, r, s)
        }
        var Ce = i(2);

        function Se(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
            }
        }
        var _e = function() {
                function e(t, i, n) {
                    ! function(e, t) {
                        if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                    }(this, e), Object(f.j)(this, r.a), this._model = t, this._api = i, this._playerElement = n, this.localization = t.get("localization"), this.state = "tooltip", this.enabled = !1, this.shown = !1, this.feedShownId = "", this.closeUi = null, this.tooltipUi = null, this.reset()
                }
                var t, i, n;
                return t = e, (i = [{
                    key: "setup",
                    value: function(e) {
                        this.container = e.createElement("div"), this.container.className = "jw-nextup-container jw-reset";
                        var t = Object(l.e)(function() {
                            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "",
                                t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "",
                                i = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : "",
                                n = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : "";
                            return '<div class="jw-nextup jw-background-color jw-reset"><div class="jw-nextup-tooltip jw-reset"><div class="jw-nextup-thumbnail jw-reset"></div><div class="jw-nextup-body jw-reset">' + '<div class="jw-nextup-header jw-reset">'.concat(e, "</div>") + '<div class="jw-nextup-title jw-reset-text" dir="auto">'.concat(t, "</div>") + '<div class="jw-nextup-duration jw-reset">'.concat(i, "</div>") + "</div></div>" + '<button type="button" class="jw-icon jw-nextup-close jw-reset" aria-label="'.concat(n, '"></button>') + "</div>"
                        }());
                        t.querySelector(".jw-nextup-close").appendChild(Object(h.a)("close")), this.addContent(t), this.closeButton = this.content.querySelector(".jw-nextup-close"), this.closeButton.setAttribute("aria-label", this.localization.close), this.tooltip = this.content.querySelector(".jw-nextup-tooltip");
                        var i = this._model,
                            n = i.player;
                        this.enabled = !1, i.on("change:nextUp", this.onNextUp, this), n.change("duration", this.onDuration, this), n.change("position", this.onElapsed, this), n.change("streamType", this.onStreamType, this), n.change("state", function(e, t) {
                            "complete" === t && this.toggle(!1)
                        }, this), this.closeUi = new u.a(this.closeButton, {
                            directSelect: !0
                        }).on("click tap enter", function() {
                            this.nextUpSticky = !1, this.toggle(!1)
                        }, this), this.tooltipUi = new u.a(this.tooltip).on("click tap", this.click, this)
                    }
                }, {
                    key: "loadThumbnail",
                    value: function(e) {
                        return this.nextUpImage = new Image, this.nextUpImage.onload = function() {
                            this.nextUpImage.onload = null
                        }.bind(this), this.nextUpImage.src = e, {
                            backgroundImage: 'url("' + e + '")'
                        }
                    }
                }, {
                    key: "click",
                    value: function() {
                        var e = this.feedShownId;
                        this.reset(), this._api.next({
                            feedShownId: e,
                            reason: "interaction"
                        })
                    }
                }, {
                    key: "toggle",
                    value: function(e, t) {
                        if (this.enabled && (Object(l.u)(this.container, "jw-nextup-sticky", !!this.nextUpSticky), this.shown !== e)) {
                            this.shown = e, Object(l.u)(this.container, "jw-nextup-container-visible", e), Object(l.u)(this._playerElement, "jw-flag-nextup", e);
                            var i = this._model.get("nextUp");
                            e && i ? (this.feedShownId = Object(ne.b)(ne.a), this.trigger("nextShown", {
                                mode: i.mode,
                                ui: "nextup",
                                itemsShown: [i],
                                feedData: i.feedData,
                                reason: t,
                                feedShownId: this.feedShownId
                            })) : this.feedShownId = ""
                        }
                    }
                }, {
                    key: "setNextUpItem",
                    value: function(e) {
                        var t = this;
                        setTimeout(function() {
                            if (t.thumbnail = t.content.querySelector(".jw-nextup-thumbnail"), Object(l.u)(t.content, "jw-nextup-thumbnail-visible", !!e.image), e.image) {
                                var i = t.loadThumbnail(e.image);
                                Object(w.d)(t.thumbnail, i)
                            }
                            t.header = t.content.querySelector(".jw-nextup-header"), t.header.textContent = t.localization.nextUp, t.title = t.content.querySelector(".jw-nextup-title");
                            var n = e.title;
                            t.title.textContent = n ? Object(l.e)(n).textContent : "";
                            var o = e.duration;
                            o && (t.duration = t.content.querySelector(".jw-nextup-duration"), t.duration.textContent = "number" == typeof o ? Object(v.timeFormat)(o) : o)
                        }, 500)
                    }
                }, {
                    key: "onNextUp",
                    value: function(e, t) {
                        this.reset(), t || (t = {
                            showNextUp: !1
                        }), this.enabled = !(!t.title && !t.image), this.enabled && (t.showNextUp || (this.nextUpSticky = !1, this.toggle(!1)), this.setNextUpItem(t))
                    }
                }, {
                    key: "onDuration",
                    value: function(e, t) {
                        if (t) {
                            var i = Object(Ce.f)(e.get("nextupoffset") || -10);
                            i < 0 && (i += t), this.offset = i
                        }
                    }
                }, {
                    key: "onElapsed",
                    value: function(e, t) {
                        var i = this.nextUpSticky;
                        if (this.enabled && !1 !== i) {
                            var n = t >= this.offset;
                            n && void 0 === i ? (this.nextUpSticky = n, this.toggle(n, "time")) : !n && i && this.reset()
                        }
                    }
                }, {
                    key: "onStreamType",
                    value: function(e, t) {
                        "VOD" !== t && (this.nextUpSticky = !1, this.toggle(!1))
                    }
                }, {
                    key: "element",
                    value: function() {
                        return this.container
                    }
                }, {
                    key: "addContent",
                    value: function(e) {
                        this.content && this.removeContent(), this.content = e, this.container.appendChild(e)
                    }
                }, {
                    key: "removeContent",
                    value: function() {
                        this.content && (this.container.removeChild(this.content), this.content = null)
                    }
                }, {
                    key: "reset",
                    value: function() {
                        this.nextUpSticky = void 0, this.toggle(!1)
                    }
                }, {
                    key: "destroy",
                    value: function() {
                        this.off(), this._model.off(null, null, this), this.closeUi && this.closeUi.destroy(), this.tooltipUi && this.tooltipUi.destroy()
                    }
                }]) && Se(t.prototype, i), n && Se(t, n), e
            }(),
            Me = function(e, t) {
                var i = e.featured,
                    n = e.showLogo,
                    o = e.type;
                return e.logo = n ? '<span class="jw-rightclick-logo jw-reset"></span>' : "", '<li class="jw-reset jw-rightclick-item '.concat(i ? "jw-featured" : "", '">').concat(Ee[o](e, t), "</li>")
            },
            Ee = {
                link: function(e) {
                    var t = e.link,
                        i = e.title,
                        n = e.logo;
                    return '<a href="'.concat(t || "", '" class="jw-rightclick-link jw-reset" target="_blank" rel="noreferrer">').concat(n).concat(i || "", "</a>")
                },
                info: function(e, t) {
                    return '<button type="button" class="jw-reset jw-rightclick-link jw-info-overlay-item">'.concat(t.videoInfo, "</button>")
                },
                share: function(e, t) {
                    return '<button type="button" class="jw-reset jw-rightclick-link jw-share-item">'.concat(t.sharing.heading, "</button>")
                },
                keyboardShortcuts: function() {
                    return '<button type="button" class="jw-reset jw-rightclick-link jw-shortcuts-item">Phím tắt</button>'
                }
            },
            Ae = i(30),
            Le = i(5),
            ze = i(13);

        function Pe(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
            }
        }

        function Ie(e) {
            var t = Object(l.e)(e),
                i = t.querySelector(".jw-rightclick-logo");
            return i && i.appendChild(Object(h.a)("jwplayer-logo")), t
        }
        var Re = function() {
            function e(t, i) {
                ! function(e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }(this, e), this.infoOverlay = t, this.shortcutsTooltip = i
            }
            var t, i, n;
            return t = e, (i = [{
                key: "buildArray",
                value: function() {
                    var e = Ae.a.split("+")[0],
                        t = this.model,
                        i = t.get("localization").poweredBy,
                        n = '<span class="jw-reset">TVH Player V 3.9.5</span>',
                        o = {
                            items: [{
                                type: "info"
                            }, {
                                title: Object(ze.g)(i) ? "".concat(n, " ").concat(i) : "".concat(i, " ").concat(n),
                                type: "link",
                                featured: !0,
                                showLogo: !0,
                                link: "http://tvhay.org/"
                            }]
                        },
                        a = t.get("provider"),
                        r = o.items;
                    if (a && a.name.indexOf("flash") >= 0) {
                        var s = "Flash Version " + Object(Le.a)();
                        r.push({
                            title: s,
                            type: "link",
                            link: "http://www.adobe.com/software/flash/about/"
                        })
                    }
                    return this.shortcutsTooltip && r.splice(r.length - 1, 0, {
                        type: "keyboardShortcuts"
                    }), o
                }
            }, {
                key: "rightClick",
                value: function(e) {
                    if (this.lazySetup(), this.mouseOverContext) return !1;
                    this.hideMenu(), this.showMenu(e), this.addHideMenuHandlers()
                }
            }, {
                key: "getOffset",
                value: function(e) {
                    var t = Object(l.c)(this.wrapperElement),
                        i = e.pageX - t.left,
                        n = e.pageY - t.top;
                    return this.model.get("touchMode") && (n -= 100), {
                        x: i,
                        y: n
                    }
                }
            }, {
                key: "showMenu",
                value: function(e) {
                    var t = this,
                        i = this.getOffset(e);
                    return this.el.style.left = i.x + "px", this.el.style.top = i.y + "px", this.outCount = 0, Object(l.a)(this.playerContainer, "jw-flag-rightclick-open"), Object(l.a)(this.el, "jw-open"), clearTimeout(this._menuTimeout), this._menuTimeout = setTimeout(function() {
                        return t.hideMenu()
                    }, 3e3), !1
                }
            }, {
                key: "hideMenu",
                value: function(e) {
                    e && this.el.contains(e.target) || (Object(l.n)(this.playerContainer, "jw-flag-rightclick-open"), Object(l.n)(this.el, "jw-open"))
                }
            }, {
                key: "lazySetup",
                value: function() {
                    var e, t, i, n, o = this,
                        a = (e = this.buildArray(), t = this.model.get("localization"), i = e.items, n = (void 0 === i ? [] : i).map(function(e) {
                            return Me(e, t)
                        }), '<div class="jw-rightclick jw-reset">' + '<ul class="jw-rightclick-list jw-reset">'.concat(n.join(""), "</ul>") + "</div>");
                    if (this.el) {
                        if (this.html !== a) {
                            this.html = a;
                            var r = Ie(a);
                            Object(l.g)(this.el);
                            for (var s = r.childNodes.length; s--;) this.el.appendChild(r.firstChild)
                        }
                    } else this.html = a, this.el = Ie(this.html), this.wrapperElement.appendChild(this.el), this.hideMenuHandler = function(e) {
                        return o.hideMenu(e)
                    }, this.overHandler = function() {
                        o.mouseOverContext = !0
                    }, this.outHandler = function(e) {
                        o.mouseOverContext = !1, e.relatedTarget && !o.el.contains(e.relatedTarget) && ++o.outCount > 1 && o.hideMenu()
                    }, this.infoOverlayHandler = function() {
                        o.mouseOverContext = !1, o.hideMenu(), o.infoOverlay.open()
                    }, this.shortcutsTooltipHandler = function() {
                        o.mouseOverContext = !1, o.hideMenu(), o.shortcutsTooltip.open()
                    }
                }
            }, {
                key: "setup",
                value: function(e, t, i) {
                    this.wrapperElement = i, this.model = e, this.mouseOverContext = !1, this.playerContainer = t, this.ui = new u.a(i).on("longPress", this.rightClick, this)
                }
            }, {
                key: "addHideMenuHandlers",
                value: function() {
                    this.removeHideMenuHandlers(), this.wrapperElement.addEventListener("touchstart", this.hideMenuHandler), document.addEventListener("touchstart", this.hideMenuHandler), o.OS.mobile || (this.wrapperElement.addEventListener("click", this.hideMenuHandler), document.addEventListener("click", this.hideMenuHandler), this.el.addEventListener("mouseover", this.overHandler), this.el.addEventListener("mouseout", this.outHandler)), this.el.querySelector(".jw-info-overlay-item").addEventListener("click", this.infoOverlayHandler), this.shortcutsTooltip && this.el.querySelector(".jw-shortcuts-item").addEventListener("click", this.shortcutsTooltipHandler)
                }
            }, {
                key: "removeHideMenuHandlers",
                value: function() {
                    this.wrapperElement && this.wrapperElement.removeEventListener("click", this.hideMenuHandler), this.el && (this.el.querySelector(".jw-info-overlay-item").removeEventListener("click", this.infoOverlayHandler), this.el.removeEventListener("mouseover", this.overHandler), this.el.removeEventListener("mouseout", this.outHandler), this.shortcutsTooltip && this.el.querySelector(".jw-shortcuts-item").removeEventListener("click", this.shortcutsTooltipHandler)), document.removeEventListener("click", this.hideMenuHandler), document.removeEventListener("touchstart", this.hideMenuHandler)
                }
            }, {
                key: "destroy",
                value: function() {
                    clearTimeout(this._menuTimeout), this.removeHideMenuHandlers(), this.el && (this.hideMenu(), this.hideMenuHandler = null, this.el = null), this.wrapperElement && (this.wrapperElement.oncontextmenu = null, this.wrapperElement = null), this.model && (this.model = null), this.ui && (this.ui.destroy(), this.ui = null)
                }
            }]) && Pe(t.prototype, i), n && Pe(t, n), e
        }();

        function Be(e) {
            return (Be = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            } : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            })(e)
        }

        function He(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
            }
        }

        function Ve(e, t) {
            return !t || "object" !== Be(t) && "function" != typeof t ? function(e) {
                if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                return e
            }(e) : t
        }

        function Ne(e, t, i) {
            return (Ne = "undefined" != typeof Reflect && Reflect.get ? Reflect.get : function(e, t, i) {
                var n = function(e, t) {
                    for (; !Object.prototype.hasOwnProperty.call(e, t) && null !== (e = qe(e)););
                    return e
                }(e, t);
                if (n) {
                    var o = Object.getOwnPropertyDescriptor(n, t);
                    return o.get ? o.get.call(i) : o.value
                }
            })(e, t, i || e)
        }

        function qe(e) {
            return (qe = Object.setPrototypeOf ? Object.getPrototypeOf : function(e) {
                return e.__proto__ || Object.getPrototypeOf(e)
            })(e)
        }

        function Fe(e, t) {
            return (Fe = Object.setPrototypeOf || function(e, t) {
                return e.__proto__ = t, e
            })(e, t)
        }
        var De = function(e) {
                function t() {
                    return function(e, t) {
                        if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                    }(this, t), Ve(this, qe(t).apply(this, arguments))
                }
                var i, n, o;
                return function(e, t) {
                    if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function");
                    e.prototype = Object.create(t && t.prototype, {
                        constructor: {
                            value: e,
                            writable: !0,
                            configurable: !0
                        }
                    }), t && Fe(e, t)
                }(t, Re), i = t, (n = [{
                    key: "buildArray",
                    value: function() {
                        var e = this.model,
                            i = Ne(qe(t.prototype), "buildArray", this).call(this),
                            n = e.get("localization").abouttext,
                            o = i.items;
                        if (n) {
                            o[1].showLogo = !1;
                            var a = {
                                title: n,
                                type: "link",
                                link: e.get("aboutlink") || o[1].link
                            };
                            o.splice(1, 0, a)
                        }
                        return this.shareHandler && o.unshift({
                            type: "share"
                        }), i
                    }
                }, {
                    key: "enableSharing",
                    value: function(e) {
                        var t = this;
                        this.shareHandler = function() {
                            t.mouseOverContext = !1, t.hideMenu(), e()
                        }
                    }
                }, {
                    key: "addHideMenuHandlers",
                    value: function() {
                        Ne(qe(t.prototype), "addHideMenuHandlers", this).call(this);
                        var e = this.el.querySelector(".jw-share-item");
                        e && e.addEventListener("click", this.shareHandler)
                    }
                }, {
                    key: "removeHideMenuHandlers",
                    value: function() {
                        if (Ne(qe(t.prototype), "removeHideMenuHandlers", this).call(this), this.el) {
                            var e = this.el.querySelector(".jw-share-item");
                            e && e.removeEventListener("click", this.shareHandler)
                        }
                    }
                }]) && He(i.prototype, n), o && He(i, o), t
            }(),
            Ue = function() {
                return '<div class="jw-reset jw-settings-menu" role="menu" aria-expanded="false"><div class="jw-reset jw-settings-topbar" role="menubar"></div></div>'
            };

        function We(e) {
            var t = document.getElementsByClassName("jw-icon-settings")[0];
            if (t) {
                var i = "Right" === e ? Object(l.j)(t) : Object(l.m)(t);
                i && i.focus()
            }
        }
        var Ze = function(e) {
                Object.keys(e).forEach(function(t) {
                    e[t].deactivate()
                })
            },
            Qe = function() {
                return '<div class="jw-reset jw-settings-submenu" role="menu" aria-expanded="false"></div>'
            };
        var Ye = function(e) {
                e.forEach(function(e) {
                    e.deactivate()
                })
            },
            Ke = function(e) {
                return '<button type="button" class="jw-reset-text jw-settings-content-item" role="menuitemradio" aria-checked="false" dir="auto">' + "".concat(e) + "</button>"
            };

        function Xe(e, t, i) {
            var n, o = Object(l.e)(Ke(t)),
                a = new u.a(o).on("click tap enter", function(e) {
                    i(e)
                }),
                r = {
                    activate: function() {
                        Object(l.u)(o, "jw-settings-item-active", !0), o.setAttribute("aria-checked", "true"), n = !0
                    },
                    deactivate: function() {
                        Object(l.u)(o, "jw-settings-item-active", !1), o.setAttribute("aria-checked", "false"), n = !1
                    },
                    element: function() {
                        return o
                    },
                    uiElement: function() {
                        return a
                    },
                    destroy: function() {
                        this.deactivate(), a.destroy()
                    }
                };
            return Object.defineProperty(r, "active", {
                enumerable: !0,
                get: function() {
                    return n
                }
            }), r
        }
        var Je = "audioTracks",
            Ge = "captions",
            $e = "quality",
            et = "playbackRates",
            tt = $e,
            it = function(e, t, i, n, o) {
                var a = e.getSubmenu(t);
                if (a) a.replaceContent(i);
                else {
                    var r = p("jw-settings-".concat(t), function(i) {
                            e.activateSubmenu(t, !1, i && "enter" !== i.type), a.element().children[0].focus()
                        }, t, [n]),
                        s = r.element();
                    s.setAttribute("role", "menuitemradio"), s.setAttribute("aria-checked", "false"), s.setAttribute("aria-label", o), (a = function(e, t, i) {
                        var n, o = [],
                            a = Object(l.e)(Qe(e)),
                            r = t.element();
                        r.setAttribute("name", e), r.className += " jw-submenu-" + e, t.show();
                        var s = function(e, t) {
                                e ? e.focus() : void 0 !== t && o[t].element().focus()
                            },
                            c = function(e) {
                                var t = Object(l.j)(r),
                                    i = Object(l.m)(r),
                                    n = Object(l.j)(e.target),
                                    a = Object(l.m)(e.target),
                                    c = e.key.replace(/(Arrow|ape)/, "");
                                switch (c) {
                                    case "Tab":
                                        s(e.shiftKey ? i : t);
                                        break;
                                    case "Left":
                                        s(i || Object(l.m)(document.getElementsByClassName("jw-icon-settings")[0]));
                                        break;
                                    case "Up":
                                        s(a, o.length - 1);
                                        break;
                                    case "Right":
                                        s(t);
                                        break;
                                    case "Down":
                                        s(n, 0)
                                }
                                e.preventDefault(), "Esc" !== c && e.stopPropagation()
                            },
                            u = {
                                addContent: function(e) {
                                    e && (e.forEach(function(e) {
                                        a.appendChild(e.element()), e.element().setAttribute("tabindex", "-1"), e.element().addEventListener("keydown", c)
                                    }), o = e)
                                },
                                replaceContent: function(e) {
                                    u.removeContent(), this.addContent(e)
                                },
                                removeContent: function() {
                                    o.forEach(function(e) {
                                        e.element().removeEventListener("keydown", c)
                                    }), Object(l.g)(a), o = []
                                },
                                getItems: function() {
                                    return o
                                },
                                activate: function() {
                                    Object(l.u)(a, "jw-settings-submenu-active", !0), a.setAttribute("aria-expanded", "true"), r.setAttribute("aria-checked", "true"), n = !0
                                },
                                deactivate: function() {
                                    Object(l.u)(a, "jw-settings-submenu-active", !1), a.setAttribute("aria-expanded", "false"), r.setAttribute("aria-checked", "false"), n = !1
                                },
                                activateItem: function(e) {
                                    var t = o[e];
                                    t && !t.active && (Ye(o), t.activate())
                                },
                                element: function() {
                                    return a
                                },
                                destroy: function() {
                                    o && (o.forEach(function(e) {
                                        e.destroy()
                                    }), this.removeContent())
                                }
                            };
                        return Object.defineProperties(u, {
                            name: {
                                enumerable: !0,
                                get: function() {
                                    return e
                                }
                            },
                            active: {
                                enumerable: !0,
                                get: function() {
                                    return n
                                }
                            },
                            categoryButtonElement: {
                                enumerable: !0,
                                get: function() {
                                    return r
                                }
                            },
                            isDefault: {
                                enumerable: !0,
                                get: function() {
                                    return i
                                }
                            }
                        }), u
                    }(t, r, t === tt)).addContent(i), "ontouchstart" in window || ie(s, t, o), e.addSubmenu(a)
                }
                return a
            };

        function nt(e) {
            e.removeSubmenu(Ge)
        }

        function ot(e) {
            e.removeSubmenu(Je)
        }

        function at(e) {
            e.removeSubmenu($e)
        }

        function rt(e) {
            e.removeSubmenu(et)
        }

        function st(e, t, i) {
            var n = e.elements.settingsButton,
                o = function(e, t, i) {
                    var n, o = function(e) {
                            /jw-(settings|video|nextup-close|sharing-link|share-item)/.test(e.target.className) || w.close()
                        },
                        a = null,
                        r = {},
                        s = Object(l.e)(Ue()),
                        c = new u.a(s).on("keydown", function(e) {
                            var t = e.sourceEvent,
                                i = e.target,
                                n = Object(l.j)(i),
                                o = Object(l.m)(i),
                                a = t.key.replace(/(Arrow|ape)/, "");
                            switch (a) {
                                case "Esc":
                                    w.close();
                                    break;
                                case "Left":
                                    o ? o.focus() : (w.close(), We(a));
                                    break;
                                case "Right":
                                    n && d.element() && i !== d.element() && n.focus();
                                    break;
                                case "Up":
                                case "Down":
                                    w.activateSubmenu(i.getAttribute("name"), "Up" === a)
                            }
                            if (t.stopPropagation(), /13|32|37|38|39|40/.test(t.keyCode)) return t.preventDefault(), !1
                        }),
                        d = p("jw-settings-close", function() {
                            w.close()
                        }, i.close, [Object(h.a)("close")]);
                    d.ui.on("keydown", function(e) {
                        var t = e.sourceEvent,
                            i = t.key.replace(/(Arrow|ape)/, "");
                        ("Enter" === i || "Right" === i || "Tab" === i && !t.shiftKey) && w.close(t), "Right" === i && We(t.key)
                    }), d.show();
                    var f = s.querySelector(".jw-settings-topbar");
                    f.appendChild(d.element());
                    var w = {
                        ui: c,
                        closeButton: d,
                        open: function(t, i) {
                            e(n = !0, i), s.setAttribute("aria-expanded", "true"), document.addEventListener("click", o), t && i && "enter" === i.type ? a.categoryButtonElement.focus() : a.element().firstChild.focus()
                        },
                        close: function(t) {
                            e(n = !1, t), a = null, Ze(r), s.setAttribute("aria-expanded", "false"), document.removeEventListener("click", o)
                        },
                        toggle: function() {
                            n ? this.close() : this.open()
                        },
                        addSubmenu: function(e) {
                            if (e) {
                                var t = e.name;
                                if (r[t] = e, e.isDefault) Object(l.l)(f, e.categoryButtonElement), e.categoryButtonElement.addEventListener("keydown", function(e) {
                                    9 === e.keyCode && e.shiftKey && w.close(e)
                                });
                                else {
                                    var i = f.querySelector(".jw-submenu-sharing");
                                    f.insertBefore(e.categoryButtonElement, i || d.element())
                                }
                                s.appendChild(e.element())
                            }
                        },
                        getSubmenu: function(e) {
                            return r[e]
                        },
                        getSubmenuNames: function() {
                            return Object.keys(r)
                        },
                        removeSubmenu: function(e) {
                            var i = r[e];
                            i && i.element().parentNode === s && (s.removeChild(i.element()), f.removeChild(i.categoryButtonElement), i.destroy(), delete r[e], Object.keys(r).length || (this.close(), t()))
                        },
                        activateSubmenu: function(e, t) {
                            var i = r[e];
                            i && (i.active || (Ze(r), i.activate(), a = i), (t ? i.element().lastChild : i.element().firstChild).focus())
                        },
                        activateFirstSubmenu: function(e) {
                            var t = Object.keys(r)[0];
                            this.activateSubmenu(t, !1, e)
                        },
                        element: function() {
                            return s
                        },
                        destroy: function() {
                            this.close(), this.ui.destroy(), this.closeButton.ui.destroy(), Object(l.g)(s)
                        }
                    };
                    return Object.defineProperties(w, {
                        visible: {
                            enumerable: !0,
                            get: function() {
                                return n
                            }
                        }
                    }), w
                }(t, function() {
                    n.hide()
                }, i);
            return e.on("settingsInteraction", function(e, t, i) {
                var n = o.getSubmenu(e),
                    a = i && "enter" !== i.type;
                (n || t) && (o.visible ? t || n.active ? o.close() : o.activateSubmenu(e, !1, a) : (n ? o.activateSubmenu(e, !1, a) : o.activateFirstSubmenu(a), o.open(t, i)))
            }), o
        }

        function lt(e, t, i, n) {
            var o = i.player,
                a = function(t, i) {
                    var n = e.getSubmenu(t);
                    n && n.activateItem(i)
                },
                r = function(t, i) {
                    !i || i.length <= 1 ? ot(e) : function(e, t, i, n, o) {
                        var a = t.map(function(t, n) {
                            return Xe(t.name, t.name, function(t) {
                                i(n), e.close(t)
                            })
                        });
                        it(e, Je, a, Object(h.a)("audio-tracks"), o).activateItem(n)
                    }(e, i, function(e) {
                        return n.setCurrentAudioTrack(e)
                    }, o.get("currentAudioTrack"), o.get("localization").audioTracks)
                },
                s = function(i, a) {
                    if (!a || a.length <= 1) at(e);
                    else {
                        var r = o.get("localization"),
                            s = r.hd,
                            l = r.auto;
                        ! function(e, t, i, n, o, a) {
                            var r = t.map(function(t, n) {
                                var o = t.label;
                                return "Auto" === o && 0 === n && (o = "".concat(a, '&nbsp;<span class="jw-reset jw-auto-label"></span>')), Xe(t.label, o, function(t) {
                                    i(n), e.close(t)
                                })
                            });
                            it(e, $e, r, Object(h.a)("quality-100"), o).activateItem(n)
                        }(e, a, function(e) {
                            return n.setCurrentQuality(e)
                        }, o.get("currentLevel"), s, l)
                    }! function(e, t) {
                        var i = e.getSubmenuNames(),
                            n = i.length > 1 || i.some(function(e) {
                                return "quality" === e || "playbackRates" === e
                            });
                        t.elements.settingsButton.toggle(n)
                    }(e, t)
                },
                l = function(t, i) {
                    o.get("supportsPlaybackRate") && "LIVE" !== o.get("streamType") && o.get("playbackRateControls") && i.length > 1 ? function(e, t, i, n, o) {
                        var a = t.map(function(t) {
                            return Xe(0, Object(ze.g)(o) ? "x" + t : t + "x", function(n) {
                                i(t), e.close(n)
                            })
                        });
                        it(e, et, a, Object(h.a)("playback-rate"), o).activateItem(n)
                    }(e, i, function(e) {
                        return n.setPlaybackRate(e)
                    }, i.indexOf(o.get("playbackRate")), o.get("localization").playbackRates) : rt(e)
                },
                c = function(e, t, i) {
                    var n = o.get("levels");
                    n && "Auto" === n[0].label && (t.getItems()[0].element().querySelector(".jw-auto-label").textContent = i ? "" : n[e.level.index].label)
                };
            o.change("levels", s, e), o.on("change:currentLevel", function(t, i) {
                var n = e.getSubmenu("quality"),
                    r = o.get("visualQuality");
                r && n && c(r, n, i), a("quality", i)
            }, e), o.change("audioTracks", r, e), o.on("change:currentAudioTrack", function(e, t) {
                a("audioTracks", t)
            }, e), o.on("change:playlistItem", function() {
                nt(e), t.elements.captionsButton.hide(), e.visible && e.close()
            }), o.change("captionsList", function(i, a) {
                var r = t.elements.captionsButton;
                if (!a || a.length <= 1) return nt(e), void r.hide();
                var s = o.get("localization"),
                    l = s.cc,
                    c = s.off;
                ! function(e, t, i, n, o, a) {
                    var r = t.map(function(t, n) {
                        var o = t.label;
                        return "Off" !== o && "off" !== t.id || 0 !== n || (o = a), Xe(t.id, o, function(t) {
                            i(n), e.close(t)
                        })
                    });
                    it(e, Ge, r, Object(h.a)("cc-off"), o).activateItem(n)
                }(e, a, function(e) {
                    return n.setCurrentCaptions(e)
                }, o.get("captionsIndex"), l, c), t.toggleCaptionsButtonState(!!o.get("captionsIndex")), r.show()
            }, e), o.change("captionsIndex", function(i, n) {
                var o = e.getSubmenu("captions");
                o && (o.activateItem(n), t.toggleCaptionsButtonState(!!n))
            }, e), o.change("playbackRates", l, e), o.change("playbackRate", function(e, t) {
                var i = o.get("playbackRates");
                i && a("playbackRates", i.indexOf(t))
            }, e), o.on("change:visualQuality", function(t, i) {
                var n = e.getSubmenu("quality");
                n && c(i, n, o.get("currentLevel"))
            }), o.on("change:castActive", function(t, i, n) {
                i !== n && (i ? (ot(e), at(e), rt(e)) : (r(0, o.get("audioTracks")), s(0, o.get("levels")), l(0, o.get("playbackRates"))))
            }, e), o.on("change:streamType", function() {
                l(0, o.get("playbackRates"))
            }, e)
        }
        var ct = i(71),
            ut = i(43),
            dt = i(14),
            pt = function(e, t, i, n) {
                var o = Object(l.e)('<div class="jw-reset jw-info-overlay jw-modal"><div class="jw-reset jw-info-container"><div class="jw-reset jw-info-title"></div><div class="jw-reset jw-info-duration"></div><div class="jw-reset jw-info-description"></div></div><div class="jw-reset jw-info-clientid"></div></div>'),
                    r = !1,
                    s = null,
                    c = !1,
                    u = function(e) {
                        /jw-info/.test(e.target.className) || f.close()
                    },
                    d = function() {
                        var i, n, a, s, c = p("jw-info-close", function() {
                            f.close()
                        }, t.get("localization").close, [Object(h.a)("close")]);
                        c.show(), Object(l.l)(o, c.element()), i = o.querySelector(".jw-info-title"), n = o.querySelector(".jw-info-duration"), a = o.querySelector(".jw-info-description"), s = o.querySelector(".jw-info-clientid"), t.change("playlistItem", function(e, t) {
                            var n = t.description,
                                o = t.title;
                            Object(l.p)(a, n || ""), Object(l.p)(i, o || "Unknown Title")
                        }), t.change("duration", function(e, i) {
                            var o = t.get("streamType"),
                                a = "";
                            switch (o) {
                                case "LIVE":
                                    a = "Live";
                                    break;
                                case "DVR":
                                    a = "DVR";
                                    break;
                                default:
                                    i && (a = Object(v.timeFormat)(i))
                            }
                            n.textContent = a
                        }, f), s.textContent = "Client ID: ".concat(function() {
                            try {
                                return window.localStorage.jwplayerLocalId
                            } catch (e) {
                                return "none"
                            }
                        }()), e.appendChild(o), r = !0
                    };
                var f = {
                    open: function() {
                        r || d(), document.addEventListener("click", u), c = !0;
                        var e = t.get("state");
                        e === a.qb && i.pause("infoOverlayInteraction"), s = e, n(!0)
                    },
                    close: function() {
                        document.removeEventListener("click", u), c = !1, t.get("state") === a.pb && s === a.qb && i.play("infoOverlayInteraction"), s = null, n(!1)
                    },
                    destroy: function() {
                        this.close(), t.off(null, null, this)
                    }
                };
                return Object.defineProperties(f, {
                    visible: {
                        enumerable: !0,
                        get: function() {
                            return c
                        }
                    }
                }), f
            };
        var ft = [{
                key: "SPACE",
                description: "play/pause"
            }, {
                key: "↑",
                description: "increase volume"
            }, {
                key: "↓",
                description: "decrease volume"
            }, {
                key: "→",
                description: "seek forwards"
            }, {
                key: "←",
                description: "seek backwards"
            }, {
                key: "c",
                description: "toggle captions"
            }, {
                key: "f",
                description: "toggle fullscreen"
            }, {
                key: "m",
                description: "mute/unmute"
            }, {
                key: "0-9",
                description: "seek to %"
            }],
            ht = function(e, t, i) {
                var n, o = !1,
                    r = null,
                    s = Object(l.e)(function() {
                        var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {},
                            t = [],
                            i = [];
                        return e.forEach(function(e) {
                            t.push('<div><span class="jw-hotkey">'.concat(e.key, "</span></div>")), i.push('<div><span class="jw-hotkey-description">'.concat(e.description, "</span></div>"))
                        }), '<div class="jw-shortcuts-tooltip jw-modal jw-reset" title="Keyboard Shortcuts"><span class="jw-hidden" id="jw-shortcuts-tooltip-explanation">Press shift question mark to access a list of keyboard shortcuts</span><div class="jw-reset jw-shortcuts-container"><div class="jw-reset jw-shortcuts-title">Keyboard Shortcuts</div><div class="jw-reset jw-shortcuts-tooltip-list"><div class="jw-shortcuts-tooltip-descriptions jw-reset">' + "".concat(i.join("")) + '</div><div class="jw-shortcuts-tooltip-keys jw-reset">' + "".concat(t.join("")) + "</div></div></div></div>"
                    }(ft)),
                    c = {
                        reason: "settingsInteraction"
                    },
                    u = function() {
                        Object(l.a)(s, "jw-open"), r = i.get("state"), s.querySelector(".jw-shortcuts-close").focus(), document.addEventListener("click", f), o = !0, t.pause(c)
                    },
                    d = function() {
                        Object(l.n)(s, "jw-open"), document.removeEventListener("click", f), e.focus(), o = !1, r === a.qb && t.play(c)
                    },
                    f = function(e) {
                        /jw-shortcuts/.test(e.target.className) || d()
                    };
                return n = p("jw-shortcuts-close", function() {
                    d()
                }, i.get("localization").close, [Object(h.a)("close")]), Object(l.l)(s, n.element()), n.show(), e.appendChild(s), {
                    el: s,
                    close: d,
                    open: u,
                    toggleVisibility: function() {
                        o ? d() : u()
                    }
                }
            },
            wt = function(e) {
                return '<div class="jw-float-icon jw-icon jw-button-color jw-reset" aria-label='.concat(e, ' tabindex="0">') + "</div>"
            };

        function gt(e) {
            return (gt = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            } : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            })(e)
        }

        function jt(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
            }
        }

        function bt(e, t) {
            return !t || "object" !== gt(t) && "function" != typeof t ? function(e) {
                if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                return e
            }(e) : t
        }

        function vt(e) {
            return (vt = Object.setPrototypeOf ? Object.getPrototypeOf : function(e) {
                return e.__proto__ || Object.getPrototypeOf(e)
            })(e)
        }

        function mt(e, t) {
            return (mt = Object.setPrototypeOf || function(e, t) {
                return e.__proto__ = t, e
            })(e, t)
        }
        var yt = function(e) {
            function t(e, i) {
                var n;
                return function(e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }(this, t), (n = bt(this, vt(t).call(this))).element = Object(l.e)(wt(i)), n.element.appendChild(Object(h.a)("close")), n.ui = new u.a(n.element).on("click tap enter", function() {
                    n.trigger(a.tb)
                }), e.appendChild(n.element), n
            }
            var i, n, o;
            return function(e, t) {
                if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function");
                e.prototype = Object.create(t && t.prototype, {
                    constructor: {
                        value: e,
                        writable: !0,
                        configurable: !0
                    }
                }), t && mt(e, t)
            }(t, r["a"]), i = t, (n = [{
                key: "destroy",
                value: function() {
                    this.element && (this.ui.destroy(), this.element.parentNode.removeChild(this.element), this.element = null)
                }
            }]) && jt(i.prototype, n), o && jt(i, o), t
        }();

        function kt(e) {
            return (kt = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            } : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            })(e)
        }

        function xt(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
            }
        }

        function Ot(e, t) {
            return !t || "object" !== kt(t) && "function" != typeof t ? function(e) {
                if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                return e
            }(e) : t
        }

        function Tt(e) {
            return (Tt = Object.setPrototypeOf ? Object.getPrototypeOf : function(e) {
                return e.__proto__ || Object.getPrototypeOf(e)
            })(e)
        }

        function Ct(e, t) {
            return (Ct = Object.setPrototypeOf || function(e, t) {
                return e.__proto__ = t, e
            })(e, t)
        }
        i(110);
        var St = o.OS.mobile ? 4e3 : 2e3;
        ut.a.cloneIcon = h.a, dt.a.forEach(function(e) {
            if (e.getState() === a.mb) {
                var t = e.getContainer().querySelector(".jw-error-msg .jw-icon");
                t && !t.hasChildNodes() && t.appendChild(ut.a.cloneIcon("error"))
            }
        });
        var _t = function() {
                return {
                    reason: "interaction"
                }
            },
            Mt = function(e) {
                function t(e, i) {
                    var n;
                    return function(e, t) {
                        if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                    }(this, t), (n = Ot(this, Tt(t).call(this))).activeTimeout = -1, n.inactiveTime = 0, n.context = e, n.controlbar = null, n.displayContainer = null, n.backdrop = null, n.enabled = !0, n.instreamState = null, n.keydownCallback = null, n.keyupCallback = null, n.blurCallback = null, n.mute = null, n.nextUpToolTip = null, n.playerContainer = i, n.wrapperElement = i.querySelector(".jw-wrapper"), n.rightClickMenu = null, n.settingsMenu = null, n.shortcutsTooltip = null, n.showing = !1, n.muteChangeCallback = null, n.unmuteCallback = null, n.logo = null, n.div = null, n.dimensions = {}, n.infoOverlay = null, n.userInactiveTimeout = function() {
                        var e = n.inactiveTime - Object(c.a)();
                        n.inactiveTime && e > 16 ? n.activeTimeout = setTimeout(n.userInactiveTimeout, e) : n.playerContainer.querySelector(".jw-tab-focus") ? n.resetActiveTimeout() : n.userInactive()
                    }, n
                }
                var i, n, u;
                return function(e, t) {
                    if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function");
                    e.prototype = Object.create(t && t.prototype, {
                        constructor: {
                            value: e,
                            writable: !0,
                            configurable: !0
                        }
                    }), t && Ct(e, t)
                }(t, r["a"]), i = t, (n = [{
                    key: "resetActiveTimeout",
                    value: function() {
                        clearTimeout(this.activeTimeout), this.activeTimeout = -1, this.inactiveTime = 0
                    }
                }, {
                    key: "enable",
                    value: function(e, t) {
                        var i = this,
                            n = this.context.createElement("div");
                        n.className = "jw-controls jw-reset", this.div = n;
                        var r = this.context.createElement("div");
                        r.className = "jw-controls-backdrop jw-reset", this.backdrop = r, this.logo = this.playerContainer.querySelector(".jw-logo");
                        var c = t.get("touchMode");
                        if (!this.displayContainer) {
                            var u = new Oe(t, e);
                            u.buttons.display.on("click tap enter", function() {
                                i.trigger(a.p), i.userActive(1e3), e.playToggle(_t())
                            }), this.div.appendChild(u.element()), this.displayContainer = u
                        }
                        this.infoOverlay = new pt(n, t, e, function(e) {
                            Object(l.u)(i.div, "jw-info-open", e), e && i.div.querySelector(".jw-info-close").focus()
                        }), o.OS.mobile || (this.shortcutsTooltip = new ht(this.wrapperElement, e, t)), this.rightClickMenu = new De(this.infoOverlay, this.shortcutsTooltip), c ? (Object(l.a)(this.playerContainer, "jw-flag-touch"), this.rightClickMenu.setup(t, this.playerContainer, this.wrapperElement)) : t.change("flashBlocked", function(e, t) {
                            t ? i.rightClickMenu.destroy() : i.rightClickMenu.setup(e, i.playerContainer, i.wrapperElement)
                        }, this);
                        var d = t.get("floating");
                        if (d) {
                            var f = new yt(n, t.get("localization").close);
                            f.on(a.tb, function() {
                                return i.trigger("dismissFloating", {
                                    doNotForward: !0
                                })
                            }), !1 !== d.dismissible && Object(l.a)(this.playerContainer, "jw-floating-dismissible")
                        }
                        var w = this.controlbar = new ue(e, t, this.playerContainer.querySelector(".jw-hidden-accessibility"));
                        if (w.on(a.tb, function() {
                                return i.userActive()
                            }), w.on("nextShown", function(e) {
                                this.trigger("nextShown", e)
                            }, this), w.on("adjustVolume", y, this), t.get("nextUpDisplay") && !w.nextUpToolTip) {
                            var g = new _e(t, e, this.playerContainer);
                            g.on("all", this.trigger, this), g.setup(this.context), w.nextUpToolTip = g, this.div.appendChild(g.element())
                        }
                        this.div.appendChild(w.element());
                        var j = null,
                            b = this.settingsMenu = st(w, function(n, o) {
                                var r = t.get("state"),
                                    s = {
                                        reason: "settingsInteraction"
                                    },
                                    c = "keydown" === (o && o.sourceEvent || o || {}).type;
                                Object(l.u)(i.div, "jw-settings-open", n), Object(ct.a)(t.get("containerWidth")) < 2 && (n && r === a.qb ? e.pause(s) : n || r !== a.pb || j !== a.qb || e.play(s));
                                var u = n || c ? 0 : St;
                                i.userActive(u), j = r;
                                var d = i.controlbar.elements.settingsButton;
                                !n && c && d && d.element().focus()
                            }, t.get("localization"));
                        lt(b, w, t, e), o.OS.mobile ? this.div.appendChild(b.element()) : (this.playerContainer.setAttribute("aria-describedby", "jw-shortcuts-tooltip-explanation"), this.div.insertBefore(b.element(), w.element()));
                        var v = function(t) {
                            if (t.get("autostartMuted")) {
                                var n = function() {
                                        return i.unmuteAutoplay(e, t)
                                    },
                                    a = function(e, t) {
                                        t || n()
                                    };
                                o.OS.mobile && (i.mute = p("jw-autostart-mute jw-off", n, t.get("localization").unmute, [Object(h.a)("volume-0")]), i.mute.show(), i.div.appendChild(i.mute.element())), w.renderVolume(!0, t.get("volume")), Object(l.a)(i.playerContainer, "jw-flag-autostart"), t.on("change:autostartFailed", n, i), t.on("change:autostartMuted change:mute", a, i), i.muteChangeCallback = a, i.unmuteCallback = n
                            }
                        };

                        function m(i) {
                            var n = 0,
                                o = t.get("duration"),
                                a = t.get("position");
                            if ("DVR" === t.get("streamType")) {
                                var r = t.get("dvrSeekLimit");
                                n = o, o = Math.max(a, -r)
                            }
                            var l = Object(s.a)(a + i, n, o);
                            e.seek(l, _t())
                        }

                        function y(i) {
                            var n = Object(s.a)(t.get("volume") + i, 0, 100);
                            e.setVolume(n)
                        }
                        t.once("change:autostartMuted", v), v(t);
                        var k = function(n) {
                            if (n.ctrlKey || n.metaKey) return !0;
                            var o = !i.settingsMenu.visible,
                                a = i.instreamState;
                            switch (n.keyCode) {
                                case 27:
                                    if (t.get("fullscreen")) e.setFullscreen(!1), i.playerContainer.blur(), i.userInactive();
                                    else {
                                        var r = e.getPlugin("related");
                                        r && r.close({
                                            type: "escape"
                                        })
                                    }
                                    i.rightClickMenu.el && i.rightClickMenu.hideMenuHandler(), i.infoOverlay.visible && i.infoOverlay.close(), i.shortcutsTooltip && i.shortcutsTooltip.close();
                                    break;
                                case 13:
                                case 32:
                                    e.playToggle(_t());
                                    break;
                                case 37:
                                    !a && o && m(-5);
                                    break;
                                case 39:
                                    !a && o && m(5);
                                    break;
                                case 38:
                                    o && y(10);
                                    break;
                                case 40:
                                    o && y(-10);
                                    break;
                                case 67:
                                    var s = e.getCaptionsList().length;
                                    if (s) {
                                        var l = (e.getCurrentCaptions() + 1) % s;
                                        e.setCurrentCaptions(l)
                                    }
                                    break;
                                case 77:
                                    e.setMute();
                                    break;
                                case 70:
                                    e.setFullscreen();
                                    break;
                                case 191:
                                    i.shortcutsTooltip && i.shortcutsTooltip.toggleVisibility();
                                    break;
                                default:
                                    if (n.keyCode >= 48 && n.keyCode <= 59) {
                                        var c = (n.keyCode - 48) / 10 * t.get("duration");
                                        e.seek(c, _t())
                                    }
                            }
                            return /13|32|37|38|39|40/.test(n.keyCode) ? (n.preventDefault(), !1) : void 0
                        };
                        this.playerContainer.addEventListener("keydown", k), this.keydownCallback = k;
                        var x = function(e) {
                            if (9 === e.keyCode) {
                                var t = i.playerContainer.contains(e.target) ? 0 : St;
                                i.userActive(t)
                            }
                        };
                        this.playerContainer.addEventListener("keyup", x), this.keyupCallback = x;
                        var O = function(e) {
                            var t = e.relatedTarget || document.querySelector(":focus");
                            t && (i.playerContainer.contains(t) || i.userInactive())
                        };
                        this.playerContainer.addEventListener("blur", O, !0), this.blurCallback = O;
                        var T = function e() {
                            "jw-shortcuts-tooltip-explanation" === i.playerContainer.getAttribute("aria-describedby") && i.playerContainer.removeAttribute("aria-describedby"), i.playerContainer.removeEventListener("blur", e, !0)
                        };
                        this.shortcutsTooltip && (this.playerContainer.addEventListener("blur", T, !0), this.onRemoveShortcutsDescription = T), this.userActive(), this.addControls(), this.addBackdrop(), t.set("controlsEnabled", !0)
                    }
                }, {
                    key: "addControls",
                    value: function() {
                        this.wrapperElement.appendChild(this.div)
                    }
                }, {
                    key: "disable",
                    value: function(e) {
                        var t = this.nextUpToolTip,
                            i = this.settingsMenu,
                            n = this.infoOverlay,
                            o = this.controlbar,
                            a = this.rightClickMenu,
                            r = this.playerContainer,
                            s = this.div;
                        clearTimeout(this.activeTimeout), this.activeTimeout = -1, this.off(), e.off(null, null, this), e.set("controlsEnabled", !1), s.parentNode && (Object(l.n)(r, "jw-flag-touch"), s.parentNode.removeChild(s)), o && o.destroy(), a && a.destroy(), this.keydownCallback && r.removeEventListener("keydown", this.keydownCallback), this.keyupCallback && r.removeEventListener("keyup", this.keyupCallback), this.blurCallback && r.removeEventListener("blur", this.blurCallback), this.onRemoveShortcutsDescription && r.removeEventListener("blur", this.onRemoveShortcutsDescription), this.displayContainer && this.displayContainer.destroy(), t && t.destroy(), i && (i.destroy(), s.removeChild(i.element())), n && n.destroy(), this.removeBackdrop()
                    }
                }, {
                    key: "controlbarHeight",
                    value: function() {
                        return this.dimensions.cbHeight || (this.dimensions.cbHeight = this.controlbar.element().clientHeight), this.dimensions.cbHeight
                    }
                }, {
                    key: "element",
                    value: function() {
                        return this.div
                    }
                }, {
                    key: "resize",
                    value: function() {
                        this.dimensions = {}
                    }
                }, {
                    key: "unmuteAutoplay",
                    value: function(e, t) {
                        var i = !t.get("autostartFailed"),
                            n = t.get("mute");
                        i ? n = !1 : t.set("playOnViewable", !1), this.muteChangeCallback && (t.off("change:autostartMuted change:mute", this.muteChangeCallback), this.muteChangeCallback = null), this.unmuteCallback && (t.off("change:autostartFailed", this.unmuteCallback), this.unmuteCallback = null), t.set("autostartFailed", void 0), t.set("autostartMuted", void 0), e.setMute(n), this.controlbar.renderVolume(n, t.get("volume")), this.mute && this.mute.hide(), Object(l.n)(this.playerContainer, "jw-flag-autostart"), this.userActive()
                    }
                }, {
                    key: "mouseMove",
                    value: function(e) {
                        var t = this.controlbar.element().contains(e.target),
                            i = this.controlbar.nextUpToolTip && this.controlbar.nextUpToolTip.element().contains(e.target),
                            n = this.logo && this.logo.contains(e.target),
                            o = t || i || n ? 0 : St;
                        this.userActive(o)
                    }
                }, {
                    key: "userActive",
                    value: function() {
                        var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : St;
                        e > 0 ? (this.inactiveTime = Object(c.a)() + e, -1 === this.activeTimeout && (this.activeTimeout = setTimeout(this.userInactiveTimeout, e))) : this.resetActiveTimeout(), this.showing || (Object(l.n)(this.playerContainer, "jw-flag-user-inactive"), this.showing = !0, this.trigger("userActive"))
                    }
                }, {
                    key: "userInactive",
                    value: function() {
                        clearTimeout(this.activeTimeout), this.activeTimeout = -1, this.settingsMenu.visible || (this.inactiveTime = 0, this.showing = !1, Object(l.a)(this.playerContainer, "jw-flag-user-inactive"), this.trigger("userInactive"))
                    }
                }, {
                    key: "addBackdrop",
                    value: function() {
                        var e = this.instreamState ? this.div : this.wrapperElement.querySelector(".jw-captions");
                        this.wrapperElement.insertBefore(this.backdrop, e)
                    }
                }, {
                    key: "removeBackdrop",
                    value: function() {
                        var e = this.backdrop.parentNode;
                        e && e.removeChild(this.backdrop)
                    }
                }, {
                    key: "setupInstream",
                    value: function() {
                        this.instreamState = !0, this.userActive(), this.addBackdrop(), this.settingsMenu && this.settingsMenu.close(), Object(l.n)(this.playerContainer, "jw-flag-autostart"), this.controlbar.elements.time.element().setAttribute("tabindex", "-1")
                    }
                }, {
                    key: "destroyInstream",
                    value: function(e) {
                        this.instreamState = null, this.addBackdrop(), e.get("autostartMuted") && Object(l.a)(this.playerContainer, "jw-flag-autostart"), this.controlbar.elements.time.element().setAttribute("tabindex", "0")
                    }
                }]) && xt(i.prototype, n), u && xt(i, u), t
            }(),
            Et = i(112),
            At = i.n(Et),
            Lt = i(113),
            zt = i.n(Lt),
            Pt = i(114),
            It = i.n(Pt),
            Rt = i(115),
            Bt = i.n(Rt),
            Ht = i(116),
            Vt = i.n(Ht),
            Nt = i(117),
            qt = i.n(Nt),
            Ft = i(118),
            Dt = i.n(Ft),
            Ut = i(119),
            Wt = i.n(Ut),
            Zt = i(120),
            Qt = i.n(Zt),
            Yt = i(121),
            Kt = i.n(Yt),
            Xt = {
                label: "facebook",
                src: "http://www.facebook.com/sharer/sharer.php?u=[URL]",
                svg: At.a,
                jwsource: "fb"
            },
            Jt = {
                label: "twitter",
                src: "http://twitter.com/intent/tweet?url=[URL]",
                svg: Dt.a,
                jwsource: "twi"
            },
            Gt = {
                label: "googleplus",
                src: "https://plus.google.com/share?url=[URL]",
                svg: zt.a,
                jwsource: "gps"
            },
            $t = {
                label: "linkedin",
                src: "https://www.linkedin.com/cws/share?url=[URL]",
                svg: It.a,
                jwsource: "lkn"
            },
            ei = {
                label: "pinterest",
                src: "http://pinterest.com/pin/create/button/?url=[URL]",
                svg: Bt.a,
                jwsource: "pin"
            },
            ti = {
                label: "reddit",
                src: "http://www.reddit.com/submit?url=[URL]",
                svg: Vt.a,
                jwsource: "rdt"
            },
            ii = {
                label: "tumblr",
                src: "http://tumblr.com/widgets/share/tool?canonicalUrl=[URL]",
                svg: qt.a,
                jwsource: "tbr"
            },
            ni = {
                label: "email",
                src: "mailto:?body=[URL]",
                svg: Wt.a,
                jwsource: "em"
            },
            oi = {
                label: "link",
                svg: Qt.a,
                jwsource: "cl"
            },
            ai = {
                label: "embed",
                svg: Kt.a,
                jwsource: "ceb"
            },
            ri = i(75),
            si = i.n(ri),
            li = !1,
            ci = function(e, t, o, a) {
                Object(f.j)(this, r.a);
                var s, c, u = this,
                    d = "jw-settings-sharing",
                    p = [Xt, Jt, ni];

                function h(e, t) {
                    var i = e.indexOf("MEDIAID");
                    return i > 0 && t ? e.replace("MEDIAID", t) : -1 === i ? e : void 0
                }

                function w(e) {
                    o.trigger("settingsInteraction", "sharing", !1, e)
                }

                function g() {
                    var i = e.getPlaylistItem(),
                        n = p.filter(function(e) {
                            return "link" === e.label
                        })[0];
                    s = function(e) {
                        var i = window.location.toString();
                        if (window.top !== window && (i = document.referrer), t.link) {
                            var n = h(t.link, e);
                            i = n || i
                        }
                        return i
                    }(i.mediaid), n ? -1 === n.src.indexOf(s) && (n.src = s) : p.push(Object(f.j)({
                        src: j(s, oi.jwsource)
                    }, oi));
                    var o = p.filter(function(e) {
                        return "embed" === e.label
                    });
                    c = function(e) {
                        var i = null;
                        if (t.code) {
                            var n = h(t.code, e);
                            i = n || i
                        }
                        return i
                    }(i.mediaid) || t.code, o[0] ? o[0].src = decodeURIComponent(c) : t.code && p.push(Object(f.j)({
                        src: decodeURIComponent(c)
                    }, ai))
                }

                function j(e, t) {
                    var i = /([?&]jwsource)=?[^&]*/;
                    if (i.test(e)) return e.replace(i, "$1=".concat(t));
                    var n = -1 === e.indexOf("?") ? "?" : "&";
                    return "".concat(e).concat(n, "jwsource=").concat(t)
                }

                function b(e) {
                    u.trigger("click", {
                        method: e
                    })
                }
                return function() {
                    if (Array.isArray(t.sites)) {
                        var i = [];
                        Object(f.i)(t.sites, function(e) {
                            Object(f.x)(e) && n[e] ? i.push(n[e]) : Object(f.w)(e) && i.push(e)
                        }), p = i
                    }
                    e.addButton(si.a, a, w, "share", d)
                }(), this.getShareMethods = function() {
                    return g(), p
                }, this.getHeading = function() {
                    return a
                }, this.onSubmenuToggle = function(e) {
                    var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "interaction";
                    e && !li && (li = !0, i(122)), u.trigger(e ? "open" : "close", {
                        visible: e,
                        method: t
                    })
                }, this.action = function(t) {
                    var i = p[t].label;
                    "embed" !== i && "link" !== i ? function(t) {
                        var i = t.src;
                        if (Object(f.t)(i)) i(s);
                        else if (null != i) {
                            var n = encodeURIComponent(j(s, t.jwsource || "share")),
                                o = i.replace(/\[URL\]/gi, n);
                            i === o && (o = i + n), e.pause({
                                reason: "sharing"
                            }), Object(l.k)(o, "_blank", {
                                rel: "noreferrer"
                            }), window.focus()
                        }
                        b(t.label)
                    }(p[t]) : b(i)
                }, this.open = function() {
                    o.trigger("sharingApi", !0)
                }, this.close = function() {
                    o.trigger("sharingApi", !1)
                }, this
            },
            ui = function(e, t) {
                var i = Object(l.e)('<div class="jw-skip jw-reset" tabindex="0" role="button"><span class="jw-text jw-skiptext jw-reset"></span><span class="jw-icon jw-icon-inline jw-skip-icon jw-reset"></span></div>');
                i.querySelector(".jw-icon").appendChild(Object(h.a)("next")), this.el = i, this.skiptext = this.el.querySelector(".jw-skiptext"), this.skipUI = new u.a(this.el).on("click tap enter", this.skipAd, this), this.model = e, this.skipMessage = e.get("skipText") || "", this.skipMessageCountdown = e.get("skipMessage") || "", this.waitTime = Object(Ce.c)(e.get("skipOffset")), e.change("duration", function(i, n) {
                    n && (this.waitTime || (this.waitTime = Object(Ce.c)(i.get("skipOffset"), n)), this.el.parentNode !== t && this.waitTime + 2 < n && (e.change("position", function(e, t) {
                        var i = this.waitTime - (t || 0);
                        i > 0 ? this.updateMessage(this.skipMessageCountdown.replace(/(\b)xx(s?\b)/gi, "$1".concat(Math.ceil(i), "$2"))) : null !== this.waitTime && (this.updateMessage(this.skipMessage), this.skippable = !0, Object(l.a)(this.el, "jw-skippable"))
                    }, this), t.appendChild(this.el)))
                }, this)
            };
        Object(f.j)(ui.prototype, r.a, {
            updateMessage: function(e) {
                Object(l.p)(this.skiptext, e), this.el.setAttribute("aria-label", e)
            },
            skipAd: function() {
                this.skippable && (this.skipUI.off(), this.trigger(a.d))
            },
            destroy: function() {
                this.model.off(null, null, this), this.skipUI && this.skipUI.destroy(), this.el && this.el.parentNode && this.el.parentNode.removeChild(this.el)
            }
        });
        var di = ui,
            pi = function(e, t, i) {
                this.api = e, this.playerElement = t, this.wrapperElement = i
            };
        Object(f.j)(pi.prototype, {
            setup: function(e) {
                var t = this;
                this.element = Object(l.e)(function(e) {
                    return '<div class="jw-dismiss-icon jw-icon jw-reset" aria-label='.concat(e, ' tabindex="0">') + "</div>"
                }(e)), this.element.appendChild(Object(h.a)("close")), this.ui = new u.a(this.element).on("click tap enter", function() {
                    t.api.remove()
                }, this), this.wrapperElement.insertBefore(this.element, this.wrapperElement.firstChild), Object(l.a)(this.playerElement, "jw-flag-top")
            },
            destroy: function() {
                this.element && (this.ui.destroy(), this.wrapperElement.removeChild(this.element), this.element = null)
            }
        });
        var fi = pi,
            hi = function(e, t, i, n) {
                var o = arguments.length > 4 && void 0 !== arguments[4] ? arguments[4] : "",
                    a = arguments.length > 5 && void 0 !== arguments[5] ? arguments[5] : "",
                    r = a ? '<img src="'.concat(a, '" class="jw-svg-icon"/>') : o;
                return "link" === e || "embed" === e ? '<div class="jw-reset jw-settings-content-item jw-sharing-copy"><button class="jw-reset jw-sharing-link" aria-checked="false" type="button" role="button">' + "".concat(r, " ").concat(n || e) + '</button><textarea readonly="true" class="jw-reset jw-sharing-textarea">' + "".concat(t) + "</textarea>" + '<div class="jw-reset jw-tooltip jw-tooltip-sharing-'.concat(n || e, '">') + '<div class="jw-text">'.concat(i, "</div>") + "</div></div>" : '<button class="jw-reset jw-settings-content-item jw-sharing-link" aria-checked="false" type="button" role="button">' + "".concat(r, " ").concat(n || e) + "</button>"
            };
        var wi = "sharing";

        function gi(e, t, i, n, o, a) {
            var r = t.map(function(e, t) {
                    return function(e, t, i) {
                        var n = Object(l.e)(hi(e.label, e.src, t, e.displayText, e.svg, e.icon)),
                            o = new u.a(n).on("click tap enter", function() {
                                s.activate(), i()
                            });
                        a = n, r = e.label, a && r && (a.setAttribute("aria-label", r), a.setAttribute("role", "button"), a.setAttribute("tabindex", "0"));
                        var a, r;
                        var s = {
                            activate: function() {
                                if ("embed" === e.label || "link" === e.label) {
                                    var t = n.querySelector(".jw-sharing-textarea");
                                    if (t.select(), document.execCommand("copy")) {
                                        var i = t.nextSibling;
                                        Object(l.a)(i, "jw-open"), setTimeout(function() {
                                            Object(l.n)(i, "jw-open")
                                        }, 1e3)
                                    } else window.prompt("Copy the text below", e.src);
                                    t.blur()
                                }
                            },
                            deactivate: function() {},
                            element: function() {
                                return n
                            },
                            destroy: function() {
                                o.destroy()
                            }
                        };
                        return Object.defineProperty(s, "active", {
                            enumerable: !0,
                            get: function() {
                                return !1
                            }
                        }), s
                    }(e, i, function() {
                        n(t)
                    })
                }),
                s = it(e, wi, r, si.a, a);
            Object(l.a)(s.element(), "jw-sharing-menu");
            var c = s.activate,
                d = s.deactivate;
            s.activate = function() {
                s.active || (c(), o(!0))
            }, s.deactivate = function() {
                s.active && (d(), o(!1))
            }
        }
        var ji = Mt.prototype.disable,
            bi = Mt.prototype.enable;
        t.default = function(e, t) {
            var i = new Mt(e, t),
                n = function() {
                    r && (r.destroy(), r = null)
                },
                o = null,
                r = null,
                s = null;
            i.disable = function(e) {
                ji.call(i, e), s && (s.destroy(), s = null)
            }, i.enable = function(e, u) {
                bi.call(i, e, u), u.change("instream", function() {
                    n()
                }), u.change("skipButton", function(t, o) {
                    n(), o && (r = new di(t, i.div)).on(a.d, function() {
                        t.set("skipButton", !1), e.skipAd()
                    })
                });
                var d = u.get("localization"),
                    p = u.get("advertising");
                p && p.outstream && p.dismissible && (s = new fi(e, t, t.querySelector(".jw-top"))).setup(d.close);
                var f = u.get("sharing");
                if (!o && f) {
                    var h = this.controlbar,
                        w = this.settingsMenu,
                        g = d.sharing;
                    o = new ci(e, f, h, g.heading), e.addPlugin("sharing", o), u.change("playlistItem", function() {
                            var e = o.getShareMethods().map(function(e) {
                                var t = g[e.label];
                                return t && (e.displayText = t), e
                            });
                            w.removeSubmenu("sharing"), gi(w, e, g.copied, o.action, c, o.getHeading())
                        }),
                        function(e, t) {
                            e.on("sharingApi", function(e) {
                                var i = t.getSubmenu("sharing");
                                i && (l = !0, e && !i.active ? (t.activateSubmenu("sharing"), t.open(), o.onSubmenuToggle(!0, "api")) : !e && i.active && (t.close(), o.onSubmenuToggle(!1, "api")))
                            })
                        }(h, w), this.rightClickMenu.enableSharing(o.open)
                }
            };
            var l = !1;
            var c = function(e) {
                l ? l = !1 : o.onSubmenuToggle(e)
            };
            return i
        }
    }, function(e, t, i) {
        "use strict";
        i.r(t);
        var n = i(36),
            o = i(10),
            a = i(3),
            r = i(0),
            s = i(14),
            l = i(58),
            c = ["repeat", "volume", "mute", "autostart"];
        var u = i(53),
            d = i(56),
            p = i(29),
            f = i(28),
            h = i(54),
            w = i(2),
            g = i(8),
            j = i(42);

        function b(e) {
            var t = !1;
            return {
                async: function() {
                    var i = this,
                        n = arguments;
                    return Promise.resolve().then(function() {
                        if (!t) return e.apply(i, n)
                    })
                },
                cancel: function() {
                    t = !0
                },
                cancelled: function() {
                    return t
                }
            }
        }
        var v = i(1);

        function m(e) {
            return function(t, i) {
                var n = e.mediaModel,
                    o = Object(r.j)({}, i, {
                        type: t
                    });
                switch (t) {
                    case a.T:
                        if (n.get(a.T) === i.mediaType) return;
                        n.set(a.T, i.mediaType);
                        break;
                    case a.U:
                        return void n.set(a.U, Object(r.j)({}, i));
                    case a.M:
                        if (i[t] === e.model.getMute()) return;
                        break;
                    case a.bb:
                        i.newstate === a.nb && (e.thenPlayPromise.cancel(), n.srcReset());
                        var s = n.attributes.mediaState;
                        n.attributes.mediaState = i.newstate, n.trigger("change:mediaState", n, i.newstate, s);
                        break;
                    case a.F:
                        return e.beforeComplete = !0, e.trigger(a.B, o), void(e.attached && !e.background && e._playbackComplete());
                    case a.G:
                        n.get("setup") ? (e.thenPlayPromise.cancel(), n.srcReset()) : (t = a.ub, o.code += 1e5);
                        break;
                    case a.K:
                        o.metadataType || (o.metadataType = "unknown");
                        var l = i.duration;
                        Object(r.z)(l) && (n.set("seekRange", i.seekRange), n.set("duration", l));
                        break;
                    case a.D:
                        n.set("buffer", i.bufferPercent);
                    case a.S:
                        n.set("seekRange", i.seekRange), n.set("position", i.position), n.set("currentTime", i.currentTime);
                        var c = i.duration;
                        Object(r.z)(c) && n.set("duration", c), t === a.S && Object(r.v)(e.item.starttime) && delete e.item.starttime;
                        break;
                    case a.R:
                        var u = e.mediaElement;
                        u && u.paused && n.set("mediaState", "paused");
                        break;
                    case a.I:
                        n.set(a.I, i.levels);
                    case a.J:
                        var d = i.currentQuality,
                            p = i.levels;
                        d > -1 && p.length > 1 && n.set("currentLevel", parseInt(d));
                        break;
                    case a.f:
                        n.set(a.f, i.tracks);
                    case a.g:
                        var f = i.currentTrack,
                            h = i.tracks;
                        f > -1 && h.length > 0 && f < h.length && n.set("currentAudioTrack", parseInt(f))
                }
                e.trigger(t, o)
            }
        }
        var y = i(6),
            k = i(52),
            x = i(49);

        function O(e) {
            return (O = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            } : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            })(e)
        }

        function T(e, t) {
            if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
        }

        function C(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
            }
        }

        function S(e, t, i) {
            return t && C(e.prototype, t), i && C(e, i), e
        }

        function _(e, t) {
            return !t || "object" !== O(t) && "function" != typeof t ? function(e) {
                if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                return e
            }(e) : t
        }

        function M(e) {
            return (M = Object.setPrototypeOf ? Object.getPrototypeOf : function(e) {
                return e.__proto__ || Object.getPrototypeOf(e)
            })(e)
        }

        function E(e, t) {
            if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function");
            e.prototype = Object.create(t && t.prototype, {
                constructor: {
                    value: e,
                    writable: !0,
                    configurable: !0
                }
            }), t && A(e, t)
        }

        function A(e, t) {
            return (A = Object.setPrototypeOf || function(e, t) {
                return e.__proto__ = t, e
            })(e, t)
        }
        var L = function(e) {
                function t() {
                    var e;
                    return T(this, t), (e = _(this, M(t).call(this))).providerController = null, e._provider = null, e.addAttributes({
                        mediaModel: new P
                    }), e
                }
                return E(t, k["a"]), S(t, [{
                    key: "setup",
                    value: function(e) {
                        return e = e || {}, this._normalizeConfig(e), Object(r.j)(this.attributes, e, x.b), this.providerController = new j.a(this.getConfiguration()), this.setAutoStart(), this
                    }
                }, {
                    key: "getConfiguration",
                    value: function() {
                        var e = this.clone(),
                            t = e.mediaModel.attributes;
                        return Object.keys(x.a).forEach(function(i) {
                            e[i] = t[i]
                        }), e.instreamMode = !!e.instream, delete e.instream, delete e.mediaModel, e
                    }
                }, {
                    key: "persistQualityLevel",
                    value: function(e, t) {
                        var i = t[e] || {},
                            n = i.label,
                            o = Object(r.z)(i.bitrate) ? i.bitrate : null;
                        this.set("bitrateSelection", o), this.set("qualityLabel", n)
                    }
                }, {
                    key: "setActiveItem",
                    value: function(e) {
                        var t = this.get("playlist")[e];
                        this.resetItem(t), this.attributes.playlistItem = null, this.set("item", e), this.set("minDvrWindow", t.minDvrWindow), this.set("dvrSeekLimit", t.dvrSeekLimit), this.set("playlistItem", t)
                    }
                }, {
                    key: "setMediaModel",
                    value: function(e) {
                        this.mediaModel && this.mediaModel !== e && this.mediaModel.off(), e = e || new P, this.set("mediaModel", e),
                            function(e) {
                                var t = e.get("mediaState");
                                e.trigger("change:mediaState", e, t, t)
                            }(e)
                    }
                }, {
                    key: "destroy",
                    value: function() {
                        this.attributes._destroyed = !0, this.off(), this._provider && (this._provider.off(null, null, this), this._provider.destroy())
                    }
                }, {
                    key: "getVideo",
                    value: function() {
                        return this._provider
                    }
                }, {
                    key: "setFullscreen",
                    value: function(e) {
                        (e = !!e) !== this.get("fullscreen") && this.set("fullscreen", e)
                    }
                }, {
                    key: "getProviders",
                    value: function() {
                        return this.providerController
                    }
                }, {
                    key: "setVolume",
                    value: function(e) {
                        if (Object(r.z)(e)) {
                            var t = Math.min(Math.max(0, e), 100);
                            this.set("volume", t);
                            var i = 0 === t;
                            i !== this.getMute() && this.setMute(i)
                        }
                    }
                }, {
                    key: "getMute",
                    value: function() {
                        return this.get("autostartMuted") || this.get("mute")
                    }
                }, {
                    key: "setMute",
                    value: function(e) {
                        if (void 0 === e && (e = !this.getMute()), this.set("mute", !!e), !e) {
                            var t = Math.max(10, this.get("volume"));
                            this.set("autostartMuted", !1), this.setVolume(t)
                        }
                    }
                }, {
                    key: "setStreamType",
                    value: function(e) {
                        this.set("streamType", e), "LIVE" === e && this.setPlaybackRate(1)
                    }
                }, {
                    key: "setProvider",
                    value: function(e) {
                        this._provider = e, z(this, e)
                    }
                }, {
                    key: "resetProvider",
                    value: function() {
                        this._provider = null, this.set("provider", void 0)
                    }
                }, {
                    key: "setPlaybackRate",
                    value: function(e) {
                        Object(r.v)(e) && (e = Math.max(Math.min(e, 4), .25), "LIVE" === this.get("streamType") && (e = 1), this.set("defaultPlaybackRate", e), this._provider && this._provider.setPlaybackRate && this._provider.setPlaybackRate(e))
                    }
                }, {
                    key: "persistCaptionsTrack",
                    value: function() {
                        var e = this.get("captionsTrack");
                        e ? this.set("captionLabel", e.name) : this.set("captionLabel", "Off")
                    }
                }, {
                    key: "setVideoSubtitleTrack",
                    value: function(e, t) {
                        this.set("captionsIndex", e), e && t && e <= t.length && t[e - 1].data && this.set("captionsTrack", t[e - 1])
                    }
                }, {
                    key: "persistVideoSubtitleTrack",
                    value: function(e, t) {
                        this.setVideoSubtitleTrack(e, t), this.persistCaptionsTrack()
                    }
                }, {
                    key: "setAutoStart",
                    value: function(e) {
                        void 0 !== e && this.set("autostart", e);
                        var t = y.OS.mobile && this.get("autostart");
                        this.set("playOnViewable", t || "viewable" === this.get("autostart"))
                    }
                }, {
                    key: "resetItem",
                    value: function(e) {
                        var t = e ? Object(w.f)(e.starttime) : 0,
                            i = e ? Object(w.f)(e.duration) : 0,
                            n = this.mediaModel;
                        this.set("playRejected", !1), this.attributes.itemMeta = {}, n.set("position", t), n.set("currentTime", 0), n.set("duration", i)
                    }
                }, {
                    key: "persistBandwidthEstimate",
                    value: function(e) {
                        Object(r.z)(e) && this.set("bandwidthEstimate", e)
                    }
                }, {
                    key: "_normalizeConfig",
                    value: function(e) {
                        var t = e.floating;
                        t && t.disabled && delete e.floating
                    }
                }]), t
            }(),
            z = function(e, t) {
                e.set("provider", t.getName()), !0 === e.get("instreamMode") && (t.instreamMode = !0), -1 === t.getName().name.indexOf("flash") && (e.set("flashThrottle", void 0), e.set("flashBlocked", !1)), e.setPlaybackRate(e.get("defaultPlaybackRate")), e.set("supportsPlaybackRate", t.supportsPlaybackRate), e.set("playbackRate", t.getPlaybackRate()), e.set("renderCaptionsNatively", t.renderNatively)
            };
        var P = function(e) {
                function t() {
                    var e;
                    return T(this, t), (e = _(this, M(t).call(this))).addAttributes({
                        mediaState: a.nb
                    }), e
                }
                return E(t, k["a"]), S(t, [{
                    key: "srcReset",
                    value: function() {
                        Object(r.j)(this.attributes, {
                            setup: !1,
                            started: !1,
                            preloaded: !1,
                            visualQuality: null,
                            buffer: 0,
                            currentTime: 0
                        })
                    }
                }]), t
            }(),
            I = L;

        function R(e) {
            return (R = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            } : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            })(e)
        }

        function B(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
            }
        }

        function H(e) {
            return (H = Object.setPrototypeOf ? Object.getPrototypeOf : function(e) {
                return e.__proto__ || Object.getPrototypeOf(e)
            })(e)
        }

        function V(e, t) {
            return (V = Object.setPrototypeOf || function(e, t) {
                return e.__proto__ = t, e
            })(e, t)
        }

        function N(e) {
            if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
            return e
        }
        var q = function(e) {
            function t(e, i) {
                var n, o, a, r;
                return function(e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }(this, t), o = this, a = H(t).call(this), (n = !a || "object" !== R(a) && "function" != typeof a ? N(o) : a).attached = !0, n.beforeComplete = !1, n.item = null, n.mediaModel = new P, n.model = i, n.provider = e, n.providerListener = new m(N(N(n))), n.thenPlayPromise = b(function() {}), (r = N(N(n))).provider.on("all", r.providerListener, r), n.eventQueue = new u.a(N(N(n)), ["trigger"], function() {
                    return !n.attached || n.background
                }), n
            }
            var i, n, o;
            return function(e, t) {
                if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function");
                e.prototype = Object.create(t && t.prototype, {
                    constructor: {
                        value: e,
                        writable: !0,
                        configurable: !0
                    }
                }), t && V(e, t)
            }(t, g["a"]), i = t, (n = [{
                key: "play",
                value: function(e) {
                    var t = this.item,
                        i = this.model,
                        n = this.mediaModel,
                        o = this.provider;
                    if (e || (e = i.get("playReason")), i.set("playRejected", !1), n.get("setup")) return o.play() || Promise.resolve();
                    n.set("setup", !0);
                    var a = this._loadAndPlay(t, o);
                    return n.get("started") ? a : this._playAttempt(a, e)
                }
            }, {
                key: "stop",
                value: function() {
                    var e = this.provider;
                    this.beforeComplete = !1, e.stop()
                }
            }, {
                key: "pause",
                value: function() {
                    this.provider.pause()
                }
            }, {
                key: "preload",
                value: function() {
                    var e = this.item,
                        t = this.mediaModel,
                        i = this.provider;
                    !e || e && "none" === e.preload || !this.attached || this.setup || this.preloaded || (t.set("preloaded", !0), i.preload(e))
                }
            }, {
                key: "destroy",
                value: function() {
                    var e = this.provider,
                        t = this.mediaModel;
                    this.off(), t.off(), e.off(), this.eventQueue.destroy(), this.detach(), e.getContainer() && e.remove(), delete e.instreamMode, this.provider = null, this.item = null
                }
            }, {
                key: "attach",
                value: function() {
                    var e = this.model,
                        t = this.provider;
                    e.setPlaybackRate(e.get("defaultPlaybackRate")), t.attachMedia(), this.attached = !0, this.eventQueue.flush(), this.beforeComplete && this._playbackComplete()
                }
            }, {
                key: "detach",
                value: function() {
                    var e = this.provider;
                    this.thenPlayPromise.cancel(), e.detachMedia(), this.attached = !1
                }
            }, {
                key: "_playAttempt",
                value: function(e, t) {
                    var i = this,
                        n = this.item,
                        o = this.mediaModel,
                        s = this.model,
                        l = this.provider,
                        c = l ? l.video : null;
                    return this.trigger(a.N, {
                        item: n,
                        playReason: t
                    }), (c ? c.paused : s.get(a.bb) !== a.qb) || s.set(a.bb, a.kb), e.then(function() {
                        o.get("setup") && (o.set("started", !0), o === s.mediaModel && function(e) {
                            var t = e.get("mediaState");
                            e.trigger("change:mediaState", e, t, t)
                        }(o))
                    }).catch(function(e) {
                        if (i.item && o === s.mediaModel) {
                            if (s.set("playRejected", !0), c && c.paused) {
                                if (c.src === location.href) return i._loadAndPlay(n, l);
                                o.set("mediaState", a.pb)
                            }
                            var u = Object(r.j)(new v.s(null, Object(v.B)(e), e), {
                                error: e,
                                item: n,
                                playReason: t
                            });
                            throw delete u.key, i.trigger(a.O, u), e
                        }
                    })
                }
            }, {
                key: "_playbackComplete",
                value: function() {
                    var e = this.item,
                        t = this.provider;
                    e && delete e.starttime, this.beforeComplete = !1, t.setState(a.lb), this.trigger(a.F, {})
                }
            }, {
                key: "_loadAndPlay",
                value: function() {
                    var e = this.item,
                        t = this.provider,
                        i = t.load(e);
                    if (i) {
                        var n = b(function() {
                            return t.play() || Promise.resolve()
                        });
                        return this.thenPlayPromise = n, i.then(n.async)
                    }
                    return t.play() || Promise.resolve()
                }
            }, {
                key: "audioTrack",
                get: function() {
                    return this.provider.getCurrentAudioTrack()
                },
                set: function(e) {
                    this.provider.setCurrentAudioTrack(e)
                }
            }, {
                key: "quality",
                get: function() {
                    return this.provider.getCurrentQuality()
                },
                set: function(e) {
                    this.provider.setCurrentQuality(e)
                }
            }, {
                key: "audioTracks",
                get: function() {
                    return this.provider.getAudioTracks()
                }
            }, {
                key: "background",
                get: function() {
                    var e = this.container,
                        t = this.provider;
                    return !!this.attached && (!!t.video && (!e || e && !e.contains(t.video)))
                },
                set: function(e) {
                    var t = this.container,
                        i = this.provider;
                    i.video ? t && (e ? this.background || (this.thenPlayPromise.cancel(), this.pause(), t.removeChild(i.video), this.container = null) : (this.eventQueue.flush(), this.beforeComplete && this._playbackComplete())) : e ? this.detach() : this.attach()
                }
            }, {
                key: "container",
                get: function() {
                    return this.provider.getContainer()
                },
                set: function(e) {
                    this.provider.setContainer(e)
                }
            }, {
                key: "mediaElement",
                get: function() {
                    return this.provider.video
                }
            }, {
                key: "preloaded",
                get: function() {
                    return this.mediaModel.get("preloaded")
                }
            }, {
                key: "qualities",
                get: function() {
                    return this.provider.getQualityLevels()
                }
            }, {
                key: "setup",
                get: function() {
                    return this.mediaModel.get("setup")
                }
            }, {
                key: "started",
                get: function() {
                    return this.mediaModel.get("started")
                }
            }, {
                key: "activeItem",
                set: function(e) {
                    var t = this.mediaModel = new P,
                        i = e ? Object(w.f)(e.starttime) : 0,
                        n = e ? Object(w.f)(e.duration) : 0,
                        o = t.attributes;
                    t.srcReset(), o.position = i, o.duration = n, this.item = e, this.provider.init(e)
                }
            }, {
                key: "controls",
                set: function(e) {
                    this.provider.setControls(e)
                }
            }, {
                key: "mute",
                set: function(e) {
                    this.provider.mute(e)
                }
            }, {
                key: "position",
                set: function(e) {
                    var t = this.provider;
                    this.model.get("scrubbing") && t.fastSeek ? t.fastSeek(e) : t.seek(e)
                }
            }, {
                key: "subtitles",
                set: function(e) {
                    this.provider.setSubtitlesTrack && this.provider.setSubtitlesTrack(e)
                }
            }, {
                key: "volume",
                set: function(e) {
                    this.provider.volume(e)
                }
            }]) && B(i.prototype, n), o && B(i, o), t
        }();

        function F(e) {
            return (F = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            } : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            })(e)
        }

        function D(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
            }
        }

        function U(e) {
            return (U = Object.setPrototypeOf ? Object.getPrototypeOf : function(e) {
                return e.__proto__ || Object.getPrototypeOf(e)
            })(e)
        }

        function W(e, t) {
            return (W = Object.setPrototypeOf || function(e, t) {
                return e.__proto__ = t, e
            })(e, t)
        }

        function Z(e) {
            if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
            return e
        }

        function Q(e, t) {
            var i = t.mediaControllerListener;
            e.off().on("all", i, t)
        }

        function Y(e) {
            return e && e.sources && e.sources[0]
        }
        var K = function(e) {
            function t(e, i) {
                var n, o, s, l, c;
                return function(e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }(this, t), o = this, (n = !(s = U(t).call(this)) || "object" !== F(s) && "function" != typeof s ? Z(o) : s).adPlaying = !1, n.background = (l = null, c = null, Object.defineProperties({
                    setNext: function(e, t) {
                        c = {
                            item: e,
                            loadPromise: t
                        }
                    },
                    isNext: function(e) {
                        return !(!c || JSON.stringify(c.item.sources[0]) !== JSON.stringify(e.sources[0]))
                    },
                    clearNext: function() {
                        c = null
                    }
                }, {
                    nextLoadPromise: {
                        get: function() {
                            return c ? c.loadPromise : null
                        }
                    },
                    currentMedia: {
                        get: function() {
                            return l
                        },
                        set: function(e) {
                            l = e
                        }
                    }
                })), n.mediaPool = i, n.mediaController = null, n.mediaControllerListener = function(e, t) {
                    return function(i, n) {
                        switch (i) {
                            case a.bb:
                                return;
                            case "flashThrottle":
                            case "flashBlocked":
                                return void e.set(i, n.value);
                            case a.V:
                            case a.M:
                                return void e.set(i, n[i]);
                            case a.P:
                                return void e.set("playbackRate", n.playbackRate);
                            case a.K:
                                Object(r.j)(e.get("itemMeta"), n.metadata);
                                break;
                            case a.J:
                                e.persistQualityLevel(n.currentQuality, n.levels);
                                break;
                            case "subtitlesTrackChanged":
                                e.persistVideoSubtitleTrack(n.currentTrack, n.tracks);
                                break;
                            case a.S:
                            case a.Q:
                            case a.R:
                            case a.X:
                            case "subtitlesTracks":
                            case "subtitlesTracksData":
                                e.trigger(i, n);
                                break;
                            case a.i:
                                return void e.persistBandwidthEstimate(n.bandwidthEstimate)
                        }
                        t.trigger(i, n)
                    }
                }(e, Z(Z(n))), n.model = e, n.providers = new j.a(e.getConfiguration()), n.loadPromise = Promise.resolve(), n.backgroundLoading = e.get("backgroundLoading"), n.backgroundLoading || e.set("mediaElement", n.mediaPool.getPrimedElement()), n
            }
            var i, n, o;
            return function(e, t) {
                if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function");
                e.prototype = Object.create(t && t.prototype, {
                    constructor: {
                        value: e,
                        writable: !0,
                        configurable: !0
                    }
                }), t && W(e, t)
            }(t, g["a"]), i = t, (n = [{
                key: "setActiveItem",
                value: function(e) {
                    var t = this,
                        i = this.model,
                        n = i.get("playlist")[e];
                    i.attributes.itemReady = !1, i.setActiveItem(e);
                    var o = Y(n);
                    if (!o) return Promise.reject(new v.s(v.o, v.h));
                    var a = this.background,
                        r = this.mediaController;
                    if (a.isNext(n)) return this._destroyActiveMedia(), this.loadPromise = this._activateBackgroundMedia(), this.loadPromise;
                    if (this._destroyBackgroundMedia(), r) {
                        if (i.get("castActive") || this._providerCanPlay(r.provider, o)) return this.loadPromise = Promise.resolve(r), r.activeItem = n, this._setActiveMedia(r), this.loadPromise;
                        this._destroyActiveMedia()
                    }
                    var s = i.mediaModel;
                    return this.loadPromise = this._setupMediaController(o).then(function(e) {
                        if (s === i.mediaModel) return e.activeItem = n, t._setActiveMedia(e), e
                    }).catch(function(e) {
                        throw t._destroyActiveMedia(), e
                    }), this.loadPromise
                }
            }, {
                key: "playVideo",
                value: function(e) {
                    var t, i = this,
                        n = this.mediaController,
                        o = this.model;
                    if (!o.get("playlistItem")) return Promise.reject(new Error("No media"));
                    if (e || (e = o.get("playReason")), n) t = n.play(e);
                    else {
                        o.set(a.bb, a.kb);
                        var r = b(function(t) {
                            if (i.mediaController && i.mediaController.mediaModel === t.mediaModel) return t.play(e);
                            throw new Error("Playback cancelled.")
                        });
                        t = this.loadPromise.catch(function(e) {
                            throw r.cancel(), e
                        }).then(r.async)
                    }
                    return t
                }
            }, {
                key: "stopVideo",
                value: function() {
                    var e = this.mediaController,
                        t = this.model,
                        i = t.get("playlist")[t.get("item")];
                    t.attributes.playlistItem = i, t.resetItem(i), e && e.stop()
                }
            }, {
                key: "preloadVideo",
                value: function() {
                    var e = this.background,
                        t = this.mediaController || e.currentMedia;
                    t && t.preload()
                }
            }, {
                key: "pause",
                value: function() {
                    var e = this.mediaController;
                    e && e.pause()
                }
            }, {
                key: "castVideo",
                value: function(e, t) {
                    var i = this.model;
                    i.attributes.itemReady = !1;
                    var n = Object(r.j)({}, t),
                        o = n.starttime = i.mediaModel.get("currentTime");
                    this._destroyActiveMedia();
                    var a = new q(e, i);
                    a.activeItem = n, this._setActiveMedia(a), i.mediaModel.set("currentTime", o)
                }
            }, {
                key: "stopCast",
                value: function() {
                    var e = this.model,
                        t = e.get("item");
                    e.get("playlist")[t].starttime = e.mediaModel.get("currentTime"), this.stopVideo(), this.setActiveItem(t)
                }
            }, {
                key: "backgroundActiveMedia",
                value: function() {
                    this.adPlaying = !0;
                    var e = this.background,
                        t = this.mediaController;
                    t && (e.currentMedia && this._destroyMediaController(e.currentMedia), t.background = !0, e.currentMedia = t, this.mediaController = null)
                }
            }, {
                key: "restoreBackgroundMedia",
                value: function() {
                    this.adPlaying = !1;
                    var e = this.background,
                        t = this.mediaController,
                        i = e.currentMedia;
                    if (i) {
                        if (t) return this._destroyMediaController(i), void(e.currentMedia = null);
                        var n = i.mediaModel.attributes;
                        n.mediaState === a.nb ? n.mediaState = a.pb : n.mediaState !== a.pb && (n.mediaState = a.kb), this._setActiveMedia(i), i.background = !1, e.currentMedia = null
                    }
                }
            }, {
                key: "backgroundLoad",
                value: function(e) {
                    var t = this.background,
                        i = Y(e);
                    t.setNext(e, this._setupMediaController(i).then(function(t) {
                        return t.activeItem = e, t.preload(), t
                    }).catch(function() {
                        t.clearNext()
                    }))
                }
            }, {
                key: "forwardEvents",
                value: function() {
                    var e = this.mediaController;
                    e && Q(e, this)
                }
            }, {
                key: "routeEvents",
                value: function(e) {
                    var t = this.mediaController;
                    t && (t.off(), e && Q(t, e))
                }
            }, {
                key: "destroy",
                value: function() {
                    this.off(), this._destroyBackgroundMedia(), this._destroyActiveMedia()
                }
            }, {
                key: "_setActiveMedia",
                value: function(e) {
                    var t = this.model,
                        i = e.mediaModel,
                        n = e.provider;
                    ! function(e, t) {
                        var i = e.get("mediaContainer");
                        i ? t.container = i : e.once("change:mediaContainer", function(e, i) {
                            t.container = i
                        })
                    }(t, e), this.mediaController = e, t.set("mediaElement", e.mediaElement), t.setMediaModel(i), t.setProvider(n), Q(e, this), t.set("itemReady", !0)
                }
            }, {
                key: "_destroyActiveMedia",
                value: function() {
                    var e = this.mediaController,
                        t = this.model;
                    e && (e.detach(), this._destroyMediaController(e), t.resetProvider(), this.mediaController = null)
                }
            }, {
                key: "_destroyBackgroundMedia",
                value: function() {
                    var e = this.background;
                    this._destroyMediaController(e.currentMedia), e.currentMedia = null, this._destroyBackgroundLoadingMedia()
                }
            }, {
                key: "_destroyMediaController",
                value: function(e) {
                    var t = this.mediaPool;
                    e && (t.recycle(e.mediaElement), e.destroy())
                }
            }, {
                key: "_setupMediaController",
                value: function(e) {
                    var t = this,
                        i = this.model,
                        n = this.providers,
                        o = function(e) {
                            return new q(new e(i.get("id"), i.getConfiguration(), t.primedElement), i)
                        },
                        a = n.choose(e),
                        r = a.provider,
                        s = a.name;
                    return r ? Promise.resolve(o(r)) : n.load(s).then(function(e) {
                        return o(e)
                    })
                }
            }, {
                key: "_activateBackgroundMedia",
                value: function() {
                    var e = this,
                        t = this.background,
                        i = this.background.nextLoadPromise,
                        n = this.model;
                    return this._destroyMediaController(t.currentMedia), t.currentMedia = null, i.then(function(i) {
                        if (i) return t.clearNext(), e.adPlaying ? (n.attributes.itemReady = !0, t.currentMedia = i) : (e._setActiveMedia(i), i.background = !1), i
                    })
                }
            }, {
                key: "_destroyBackgroundLoadingMedia",
                value: function() {
                    var e = this,
                        t = this.background,
                        i = this.background.nextLoadPromise;
                    i && i.then(function(i) {
                        e._destroyMediaController(i), t.clearNext()
                    })
                }
            }, {
                key: "_providerCanPlay",
                value: function(e, t) {
                    var i = this.providers.choose(t).provider;
                    return i && e && e instanceof i
                }
            }, {
                key: "audioTrack",
                get: function() {
                    var e = this.mediaController;
                    return e ? e.audioTrack : -1
                },
                set: function(e) {
                    var t = this.mediaController;
                    t && (t.audioTrack = parseInt(e, 10) || 0)
                }
            }, {
                key: "audioTracks",
                get: function() {
                    var e = this.mediaController;
                    if (e) return e.audioTracks
                }
            }, {
                key: "beforeComplete",
                get: function() {
                    var e = this.mediaController,
                        t = this.background.currentMedia;
                    return !(!e && !t) && (e ? e.beforeComplete : t.beforeComplete)
                }
            }, {
                key: "primedElement",
                get: function() {
                    return this.backgroundLoading ? this.mediaPool.getPrimedElement() : this.model.get("mediaElement")
                }
            }, {
                key: "quality",
                get: function() {
                    return this.mediaController ? this.mediaController.quality : -1
                },
                set: function(e) {
                    var t = this.mediaController;
                    t && (t.quality = parseInt(e, 10) || 0)
                }
            }, {
                key: "qualities",
                get: function() {
                    var e = this.mediaController;
                    return e ? e.qualities : null
                }
            }, {
                key: "attached",
                set: function(e) {
                    var t = this.mediaController;
                    if (t)
                        if (e) t.attach();
                        else {
                            t.detach();
                            var i = t.item,
                                n = t.mediaModel.get("position");
                            n && (i.starttime = n)
                        }
                }
            }, {
                key: "controls",
                set: function(e) {
                    var t = this.mediaController;
                    t && (t.controls = e)
                }
            }, {
                key: "mute",
                set: function(e) {
                    var t = this.background,
                        i = this.mediaController,
                        n = this.mediaPool;
                    i && (i.mute = e), t.currentMedia && (t.currentMedia.mute = e), n.syncMute(e)
                }
            }, {
                key: "position",
                set: function(e) {
                    var t = this.mediaController;
                    t && (t.item.starttime = e, t.attached && (t.position = e))
                }
            }, {
                key: "subtitles",
                set: function(e) {
                    var t = this.mediaController;
                    t && (t.subtitles = e)
                }
            }, {
                key: "volume",
                set: function(e) {
                    var t = this.background,
                        i = this.mediaController,
                        n = this.mediaPool;
                    i && (i.volume = e), t.currentMedia && (t.currentMedia.volume = e), n.syncVolume(e)
                }
            }]) && D(i.prototype, n), o && D(i, o), t
        }();

        function X(e) {
            return e === a.lb || e === a.mb ? a.nb : e
        }

        function J(e, t, i) {
            if ((t = X(t)) !== (i = X(i))) {
                var n = t.replace(/(?:ing|d)$/, ""),
                    o = {
                        type: n,
                        newstate: t,
                        oldstate: i,
                        reason: function(e, t) {
                            return e === a.kb ? t === a.rb ? t : a.ob : t
                        }(t, e.mediaModel.get("mediaState"))
                    };
                "play" === n ? o.playReason = e.get("playReason") : "pause" === n && (o.pauseReason = e.get("pauseReason")), this.trigger(n, o)
            }
        }
        var G = i(57);

        function $(e) {
            return ($ = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            } : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            })(e)
        }

        function ee(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
            }
        }

        function te(e, t) {
            return !t || "object" !== $(t) && "function" != typeof t ? function(e) {
                if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                return e
            }(e) : t
        }

        function ie(e, t, i, n) {
            return (ie = "undefined" != typeof Reflect && Reflect.set ? Reflect.set : function(e, t, i, n) {
                var o, a = ae(e, t);
                if (a) {
                    if ((o = Object.getOwnPropertyDescriptor(a, t)).set) return o.set.call(n, i), !0;
                    if (!o.writable) return !1
                }
                if (o = Object.getOwnPropertyDescriptor(n, t)) {
                    if (!o.writable) return !1;
                    o.value = i, Object.defineProperty(n, t, o)
                } else ! function(e, t, i) {
                    t in e ? Object.defineProperty(e, t, {
                        value: i,
                        enumerable: !0,
                        configurable: !0,
                        writable: !0
                    }) : e[t] = i
                }(n, t, i);
                return !0
            })(e, t, i, n)
        }

        function ne(e, t, i, n, o) {
            if (!ie(e, t, i, n || e) && o) throw new Error("failed to set property");
            return i
        }

        function oe(e, t, i) {
            return (oe = "undefined" != typeof Reflect && Reflect.get ? Reflect.get : function(e, t, i) {
                var n = ae(e, t);
                if (n) {
                    var o = Object.getOwnPropertyDescriptor(n, t);
                    return o.get ? o.get.call(i) : o.value
                }
            })(e, t, i || e)
        }

        function ae(e, t) {
            for (; !Object.prototype.hasOwnProperty.call(e, t) && null !== (e = re(e)););
            return e
        }

        function re(e) {
            return (re = Object.setPrototypeOf ? Object.getPrototypeOf : function(e) {
                return e.__proto__ || Object.getPrototypeOf(e)
            })(e)
        }

        function se(e, t) {
            return (se = Object.setPrototypeOf || function(e, t) {
                return e.__proto__ = t, e
            })(e, t)
        }
        var le = function(e) {
                function t(e, i) {
                    var n;
                    ! function(e, t) {
                        if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                    }(this, t);
                    var o, a = (n = te(this, re(t).call(this, e, i))).model = new I;
                    if (n.playerModel = e, n.provider = null, n.backgroundLoading = e.get("backgroundLoading"), a.mediaModel.attributes.mediaType = "video", n.backgroundLoading) o = i.getAdElement();
                    else {
                        o = e.get("mediaElement"), a.attributes.mediaElement = o, a.attributes.mediaSrc = o.src;
                        var r = n.srcResetListener = function() {
                            n.srcReset()
                        };
                        o.addEventListener("emptied", r), o.playbackRate = o.defaultPlaybackRate = 1
                    }
                    return n.mediaPool = Object(G.a)(o, i), n
                }
                var i, n, o;
                return function(e, t) {
                    if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function");
                    e.prototype = Object.create(t && t.prototype, {
                        constructor: {
                            value: e,
                            writable: !0,
                            configurable: !0
                        }
                    }), t && se(e, t)
                }(t, K), i = t, (n = [{
                    key: "setup",
                    value: function() {
                        var e = this.model,
                            t = this.playerModel,
                            i = this.primedElement,
                            n = t.attributes,
                            o = t.mediaModel;
                        e.setup({
                            id: n.id,
                            volume: n.volume,
                            instreamMode: !0,
                            edition: n.edition,
                            mediaContext: o,
                            mute: n.mute,
                            streamType: "VOD",
                            autostartMuted: n.autostartMuted,
                            autostart: n.autostart,
                            advertising: n.advertising,
                            sdkplatform: n.sdkplatform,
                            skipButton: !1
                        }), e.on("fullscreenchange", this._nativeFullscreenHandler), e.on("change:state", J, this), e.on(a.w, function(e) {
                            this.trigger(a.w, e)
                        }, this), i.paused || i.pause()
                    }
                }, {
                    key: "setActiveItem",
                    value: function(e) {
                        var i = this;
                        return this.stopVideo(), this.provider = null, oe(re(t.prototype), "setActiveItem", this).call(this, e).then(function(e) {
                            i._setProvider(e.provider)
                        }), this.playVideo()
                    }
                }, {
                    key: "usePsuedoProvider",
                    value: function(e) {
                        this.provider = e, e && (this._setProvider(e), e.off(a.w), e.on(a.w, function(e) {
                            this.trigger(a.w, e)
                        }, this))
                    }
                }, {
                    key: "_setProvider",
                    value: function(e) {
                        var t = this;
                        if (e && this.mediaPool) {
                            var i = this.model,
                                n = this.playerModel,
                                o = "vpaid" === e.type;
                            e.off(), e.on("all", function(e, t) {
                                o && e === a.F || this.trigger(e, Object(r.j)({}, t, {
                                    type: e
                                }))
                            }, this);
                            var s = i.mediaModel;
                            e.on(a.bb, function(e) {
                                e.oldstate = i.get(a.bb), s.set("mediaState", e.newstate)
                            }), s.on("change:mediaState", function(e, i) {
                                t._stateHandler(i)
                            }), e.attachMedia(), e.volume(n.get("volume")), e.mute(n.getMute()), e.setPlaybackRate && e.setPlaybackRate(1), n.on("change:volume", function(e, t) {
                                this.volume = t
                            }, this), n.on("change:mute", function(e, t) {
                                this.mute = t, t || (this.volume = n.get("volume"))
                            }, this), n.on("change:autostartMuted", function(e, t) {
                                t || (i.set("autostartMuted", t), this.mute = n.get("mute"))
                            }, this)
                        }
                    }
                }, {
                    key: "destroy",
                    value: function() {
                        var e = this.model,
                            t = this.mediaPool,
                            i = this.playerModel;
                        e.off();
                        var n = t.getPrimedElement();
                        if (this.backgroundLoading) {
                            t.clean();
                            var o = i.get("mediaContainer");
                            n.parentNode === o && o.removeChild(n)
                        } else n && (n.removeEventListener("emptied", this.srcResetListener), n.src !== e.get("mediaSrc") && this.srcReset())
                    }
                }, {
                    key: "srcReset",
                    value: function() {
                        var e = this.playerModel,
                            t = e.get("mediaModel"),
                            i = e.getVideo();
                        t.srcReset(), i && (i.src = null)
                    }
                }, {
                    key: "_nativeFullscreenHandler",
                    value: function(e) {
                        this.model.trigger(e.type, e), this.trigger(a.y, {
                            fullscreen: e.jwstate
                        })
                    }
                }, {
                    key: "_stateHandler",
                    value: function(e) {
                        var t = this.model;
                        switch (e) {
                            case a.qb:
                            case a.pb:
                                t.set(a.bb, e)
                        }
                    }
                }, {
                    key: "mute",
                    set: function(e) {
                        var i = this.mediaController,
                            n = this.model,
                            o = this.provider;
                        n.set("mute", e), ne(re(t.prototype), "mute", e, this, !0), i || o.mute(e)
                    }
                }, {
                    key: "volume",
                    set: function(e) {
                        var i = this.mediaController,
                            n = this.model,
                            o = this.provider;
                        n.set("volume", e), ne(re(t.prototype), "volume", e, this, !0), i || o.volume(e)
                    }
                }]) && ee(i.prototype, n), o && ee(i, o), t
            }(),
            ce = {
                skipoffset: null,
                tag: null
            },
            ue = function(e, t, i, n) {
                var o, s, l, c, u = this,
                    d = this,
                    p = new le(t, n),
                    f = 0,
                    g = {},
                    j = {},
                    b = L,
                    v = !1,
                    m = !1,
                    y = !1,
                    k = !1,
                    x = function(e) {
                        m || ((e = e || {}).hasControls = !!t.get("controls"), u.trigger(a.z, e), p.model.get("state") === a.pb ? e.hasControls && p.playVideo().catch(function() {}) : p.pause())
                    },
                    O = function() {
                        m || p.model.get("state") === a.pb && t.get("controls") && (e.setFullscreen(), e.play())
                    };

                function T() {
                    p.model.set("playRejected", !0)
                }

                function C() {
                    f++, d.loadItem(o)
                }

                function S(e, t) {
                    "complete" !== e && (t = t || {}, j.tag && !t.tag && (t.tag = j.tag), this.trigger(e, t), "mediaError" !== e && "error" !== e || o && f + 1 < o.length && C())
                }

                function _(e) {
                    var t = e.newstate,
                        i = e.oldstate || p.model.get("state");
                    i !== t && M(Object(r.j)({
                        oldstate: i
                    }, g, e))
                }

                function M(t) {
                    var i = t.newstate;
                    i === a.qb ? e.trigger(a.c, t) : i === a.pb && e.trigger(a.b, t)
                }

                function E(t) {
                    var i = t.duration,
                        n = t.position,
                        o = p.model.mediaModel || p.model;
                    o.set("duration", i), o.set("position", n), c || (c = (Object(w.c)(l, i) || i) - h.b), !v && n >= Math.max(c, h.a) && (e.preloadNextItem(), v = !0)
                }

                function A(e) {
                    var t = {};
                    j.tag && (t.tag = j.tag), this.trigger(a.F, t), L.call(this, e)
                }

                function L(e) {
                    g = {}, o && f + 1 < o.length ? C() : (e.type === a.F && this.trigger(a.cb, {}), this.destroy())
                }

                function z() {
                    m || i.clickHandler() && i.clickHandler().setAlternateClickHandlers(x, O)
                }

                function P(e) {
                    e.width && e.height && i.resizeMedia()
                }
                this.init = function() {
                    if (!y && !m) {
                        y = !0, g = {}, p.setup(), p.on("all", S, this), p.on(a.O, T, this), p.on(a.S, E, this), p.on(a.F, A, this), p.on(a.K, P, this), p.on(a.bb, _, this), e.detachMedia();
                        var n = p.primedElement;
                        t.get("mediaContainer").appendChild(n), t.set("instream", p), p.model.set("state", a.kb);
                        var o = i.clickHandler();
                        return o && o.setAlternateClickHandlers(function() {}, null), this.setText(t.get("localization").loadingAd), k = e.isBeforeComplete() || t.get("state") === a.lb, this
                    }
                }, this.enableAdsMode = function(n) {
                    var o = this;
                    if (!y && !m) return e.routeEvents({
                            mediaControllerListener: function(e, t) {
                                o.trigger(e, t)
                            }
                        }), t.set("instream", p), p.model.set("state", a.qb),
                        function(n) {
                            var o = i.clickHandler();
                            o && o.setAlternateClickHandlers(function(i) {
                                m || ((i = i || {}).hasControls = !!t.get("controls"), d.trigger(a.z, i), n && (t.get("state") === a.pb ? e.playVideo() : (e.pause(), n && (e.trigger(a.a, {
                                    clickThroughUrl: n
                                }), window.open(n)))))
                            }, null)
                        }(n), this
                }, this.setEventData = function(e) {
                    g = e
                }, this.setState = function(e) {
                    var t = e.newstate,
                        i = p.model;
                    e.oldstate = i.get("state"), i.set("state", t), M(e)
                }, this.setTime = function(t) {
                    E(t), e.trigger(a.e, t)
                }, this.loadItem = function(e, i) {
                    if (m || !y) return Promise.reject(new Error("Instream not setup"));
                    g = {};
                    var n = e;
                    Array.isArray(e) ? (s = i || s, e = (o = e)[f], s && (i = s[f])) : n = [e];
                    var c = p.model;
                    c.set("playlist", n), t.set("hideAdsControls", !1), e.starttime = 0, d.trigger(a.db, {
                        index: f,
                        item: e
                    }), j = Object(r.j)({}, ce, i), z(), c.set("skipButton", !1);
                    var u = p.setActiveItem(f);
                    return v = !1, (l = e.skipoffset || j.skipoffset) && d.setupSkipButton(l, j), u
                }, this.setupSkipButton = function(e, t, i) {
                    var n = p.model;
                    b = i || L, n.set("skipMessage", t.skipMessage), n.set("skipText", t.skipText), n.set("skipOffset", e), n.attributes.skipButton = !1, n.set("skipButton", !0)
                }, this.applyProviderListeners = function(e) {
                    p.usePsuedoProvider(e), z()
                }, this.play = function() {
                    g = {}, p.playVideo()
                }, this.pause = function() {
                    g = {}, p.pause()
                }, this.skipAd = function(e) {
                    var t = a.d;
                    this.trigger(t, e), b.call(this, {
                        type: t
                    })
                }, this.replacePlaylistItem = function(e) {
                    m || (t.set("playlistItem", e), p.srcReset())
                }, this.destroy = function() {
                    m || (m = !0, this.trigger("destroyed"), this.off(), i.clickHandler() && i.clickHandler().revertAlternateClickHandlers(), t.off(null, null, p), p.off(null, null, d), p.destroy(), y && p.model && (t.attributes.state = a.pb), e.forwardEvents(), t.set("instream", null), p = null, g = {}, y && !t.attributes._destroyed && (e.attachMedia(), this.noResume || (k ? e.stopVideo() : e.playVideo())))
                }, this.getState = function() {
                    return !m && p.model.get("state")
                }, this.setText = function(e) {
                    return m ? this : (i.setAltText(e || ""), this)
                }, this.hide = function() {
                    m || t.set("hideAdsControls", !0)
                }, this.getMediaElement = function() {
                    return m ? null : p.primedElement
                }, this.setSkipOffset = function(e) {
                    l = e > 0 ? e : null, p && p.model.set("skipOffset", l)
                }
            };
        Object(r.j)(ue.prototype, g.a);
        var de = ue,
            pe = i(69),
            fe = i(68),
            he = function(e) {
                var t = this,
                    i = [],
                    n = {},
                    o = 0,
                    r = 0;

                function s(e) {
                    if (e.data = e.data || [], e.name = e.label || e.name || e.language, e._id = Object(fe.a)(e, i.length), !e.name) {
                        var t = Object(fe.b)(e, o);
                        e.name = t.label, o = t.unknownCount
                    }
                    n[e._id] = e, i.push(e)
                }

                function l() {
                    for (var e = [{
                            id: "off",
                            label: "Off"
                        }], t = 0; t < i.length; t++) e.push({
                        id: i[t]._id,
                        label: i[t].name || "Unknown CC"
                    });
                    return e
                }

                function c(t) {
                    var n = r = t,
                        o = e.get("captionLabel");
                    if ("Off" !== o) {
                        for (var a = 0; a < i.length; a++) {
                            var s = i[a];
                            if (o && o === s.name) {
                                n = a + 1;
                                break
                            }
                            s.default || s.defaulttrack || "default" === s._id ? n = a + 1 : s.autoselect
                        }
                        var l;
                        l = n, i.length ? e.setVideoSubtitleTrack(l, i) : e.set("captionsIndex", l)
                    } else e.set("captionsIndex", 0)
                }

                function u() {
                    var t = l();
                    d(t) !== d(e.get("captionsList")) && (c(r), e.set("captionsList", t))
                }

                function d(e) {
                    return e.map(function(e) {
                        return "".concat(e.id, "-").concat(e.label)
                    }).join(",")
                }
                e.on("change:playlistItem", function(e) {
                    i = [], n = {}, o = 0;
                    var t = e.attributes;
                    t.captionsIndex = 0, t.captionsList = l(), e.set("captionsTrack", null)
                }, this), e.on("change:itemReady", function() {
                    var i = e.get("playlistItem").tracks,
                        o = i && i.length;
                    if (o && !e.get("renderCaptionsNatively"))
                        for (var r = function(e) {
                                var o, r = i[e];
                                "subtitles" !== (o = r.kind) && "captions" !== o || n[r._id] || (s(r), Object(pe.c)(r, function(e) {
                                    ! function(e, t) {
                                        e.data = t
                                    }(r, e)
                                }, function(e) {
                                    t.trigger(a.ub, e)
                                }))
                            }, l = 0; l < o; l++) r(l);
                    u()
                }, this), e.on("change:captionsIndex", function(e, t) {
                    var n = null;
                    0 !== t && (n = i[t - 1]), e.set("captionsTrack", n)
                }, this), this.setSubtitlesTracks = function(e) {
                    if (e.length) {
                        for (var t = 0; t < e.length; t++) s(e[t]);
                        i = Object.keys(n).map(function(e) {
                            return n[e]
                        }), u()
                    }
                }, this.selectDefaultIndex = c, this.getCurrentIndex = function() {
                    return e.get("captionsIndex")
                }, this.getCaptionsList = function() {
                    return e.get("captionsList")
                }, this.destroy = function() {
                    this.off(null, null, this)
                }
            };
        Object(r.j)(he.prototype, g.a);
        var we = he,
            ge = function(e, t) {
                return '<div id="'.concat(e, '" class="jwplayer jw-reset jw-state-setup" tabindex="0" aria-label="').concat(t || "", '" role="application">') + '<div class="jw-aspect jw-reset"></div><div class="jw-wrapper jw-reset"><div class="jw-top jw-reset"></div><div class="jw-aspect jw-reset"></div><div class="jw-media jw-reset"></div><div class="jw-preview jw-reset"></div><div class="jw-title jw-reset-text" dir="auto"><div class="jw-title-primary jw-reset-text"></div><div class="jw-title-secondary jw-reset-text"></div></div><div class="jw-overlays jw-reset"></div><div class="jw-hidden-accessibility"><span class="jw-time-update" aria-live="assertive"></span><span class="jw-volume-update" aria-live="assertive"></span></div></div></div>'
            },
            je = i(43),
            be = 44,
            ve = function(e) {
                var t = e.get("height");
                if (e.get("aspectratio")) return !1;
                if ("string" == typeof t && t.indexOf("%") > -1) return !1;
                var i = 1 * t || NaN;
                return !!(i = isNaN(i) ? e.get("containerHeight") : i) && (i && i <= be)
            },
            me = i(80);

        function ye(e, t) {
            if (e.get("fullscreen")) return 1;
            if (!e.get("activeTab")) return 0;
            if (e.get("isFloating")) return 1;
            var i = e.get("intersectionRatio");
            return void 0 === i && (i = function(e) {
                var t = document.documentElement,
                    i = document.body,
                    n = {
                        top: 0,
                        left: 0,
                        right: t.clientWidth || i.clientWidth,
                        width: t.clientWidth || i.clientWidth,
                        bottom: t.clientHeight || i.clientHeight,
                        height: t.clientHeight || i.clientHeight
                    };
                if (!i.contains(e)) return 0;
                if ("none" === window.getComputedStyle(e).display) return 0;
                var o = ke(e);
                if (!o) return 0;
                var a = o,
                    r = e.parentNode,
                    s = !1;
                for (; !s;) {
                    var l = null;
                    if (r === i || r === t || 1 !== r.nodeType ? (s = !0, l = n) : "visible" !== window.getComputedStyle(r).overflow && (l = ke(r)), l && (c = l, u = a, d = void 0, p = void 0, f = void 0, h = void 0, w = void 0, g = void 0, d = Math.max(c.top, u.top), p = Math.min(c.bottom, u.bottom), f = Math.max(c.left, u.left), h = Math.min(c.right, u.right), g = p - d, !(a = (w = h - f) >= 0 && g >= 0 && {
                            top: d,
                            bottom: p,
                            left: f,
                            right: h,
                            width: w,
                            height: g
                        }))) return 0;
                    r = r.parentNode
                }
                var c, u, d, p, f, h, w, g;
                var j = o.width * o.height,
                    b = a.width * a.height;
                return j ? b / j : 0
            }(t), window.top !== window.self && i) ? 0 : i
        }

        function ke(e) {
            try {
                return e.getBoundingClientRect()
            } catch (e) {}
        }
        var xe = i(73),
            Oe = i(67),
            Te = i(71),
            Ce = i(23);
        var Se = i(38),
            _e = i(9),
            Me = i(5),
            Ee = ["fullscreenchange", "webkitfullscreenchange", "mozfullscreenchange", "MSFullscreenChange"],
            Ae = function(e, t, i) {
                for (var n = e.requestFullscreen || e.webkitRequestFullscreen || e.webkitRequestFullScreen || e.mozRequestFullScreen || e.msRequestFullscreen, o = t.exitFullscreen || t.webkitExitFullscreen || t.webkitCancelFullScreen || t.mozCancelFullScreen || t.msExitFullscreen, a = !(!n || !o), r = Ee.length; r--;) t.addEventListener(Ee[r], i);
                return {
                    events: Ee,
                    supportsDomFullscreen: function() {
                        return a
                    },
                    requestFullscreen: function() {
                        n.apply(e)
                    },
                    exitFullscreen: function() {
                        null !== this.fullscreenElement() && o.apply(t)
                    },
                    fullscreenElement: function() {
                        var e = t.fullscreenElement,
                            i = t.webkitCurrentFullScreenElement,
                            n = t.mozFullScreenElement,
                            o = t.msFullscreenElement;
                        return null === e ? e : e || i || n || o
                    },
                    destroy: function() {
                        for (var e = Ee.length; e--;) t.removeEventListener(Ee[e], i)
                    }
                }
            },
            Le = i(35);

        function ze(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
            }
        }
        var Pe, Ie = function() {
                function e(t, i) {
                    ! function(e, t) {
                        if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                    }(this, e), Object(r.j)(this, g.a), this.revertAlternateClickHandlers(), this.domElement = i, this.model = t, this.ui = new Le.a(i).on("click tap", this.clickHandler, this).on("doubleClick doubleTap", function() {
                        this.alternateDoubleClickHandler ? this.alternateDoubleClickHandler() : this.trigger("doubleClick")
                    }, this)
                }
                var t, i, n;
                return t = e, (i = [{
                    key: "destroy",
                    value: function() {
                        this.ui && (this.ui.destroy(), this.ui = this.domElement = this.model = null, this.revertAlternateClickHandlers())
                    }
                }, {
                    key: "clickHandler",
                    value: function(e) {
                        this.model.get("flashBlocked") || (this.alternateClickHandler ? this.alternateClickHandler(e) : this.trigger(e.type === a.n ? "click" : "tap"))
                    }
                }, {
                    key: "element",
                    value: function() {
                        return this.domElement
                    }
                }, {
                    key: "setAlternateClickHandlers",
                    value: function(e, t) {
                        this.alternateClickHandler = e, this.alternateDoubleClickHandler = t || null
                    }
                }, {
                    key: "revertAlternateClickHandlers",
                    value: function() {
                        this.alternateClickHandler = null, this.alternateDoubleClickHandler = null
                    }
                }]) && ze(t.prototype, i), n && ze(t, n), e
            }(),
            Re = {
                back: !0,
                backgroundOpacity: 50,
                edgeStyle: null,
                fontSize: 14,
                fontOpacity: 100,
                fontScale: .05,
                preprocessor: r.o,
                windowOpacity: 0
            },
            Be = function(e) {
                var t, n, s, l, c, u, d, p, f, h = this,
                    w = e.player;

                function g() {
                    Object(r.s)(t.fontSize) && (w.get("containerHeight") ? p = Re.fontScale * t.fontSize / Re.fontSize : w.once("change:containerHeight", g, this))
                }

                function j() {
                    var e = w.get("containerHeight");
                    if (e) {
                        var t;
                        if (w.get("fullscreen") && y.OS.iOS) t = "inherit";
                        else {
                            var i = e * p;
                            t = Math.round(10 * function(e) {
                                var t = w.get("mediaElement");
                                if (t && t.videoHeight) {
                                    var i = t.videoWidth,
                                        n = t.videoHeight,
                                        o = i / n,
                                        a = w.get("containerHeight"),
                                        r = w.get("containerWidth");
                                    if (w.get("fullscreen") && y.OS.mobile) {
                                        var s = window,
                                            l = s.screen;
                                        l.orientation && (a = l.availHeight, r = l.availWidth)
                                    }
                                    if (r && a && i && n) {
                                        var c = r / a,
                                            u = c > o ? a : n * r / i;
                                        return u * p
                                    }
                                }
                                return e
                            }(i)) / 10
                        }
                        w.get("renderCaptionsNatively") ? function(e, t) {
                            f.fontSize = t + "px", Object(Ce.b)("#" + e + " .jw-video::-webkit-media-text-track-display", f, e, !0)
                        }(w.get("id"), t) : Object(Ce.d)(c, {
                            fontSize: t
                        })
                    }
                }

                function b(e, t, i) {
                    var n = Object(Ce.c)("#000000", i);
                    "dropshadow" === e ? t.textShadow = "0 2px 1px " + n : "raised" === e ? t.textShadow = "0 0 5px " + n + ", 0 1px 5px " + n + ", 0 2px 5px " + n : "depressed" === e ? t.textShadow = "0 -2px 1px " + n : "uniform" === e && (t.textShadow = "-2px 0 1px " + n + ",2px 0 1px " + n + ",0 -2px 1px " + n + ",0 2px 1px " + n + ",-1px 1px 1px " + n + ",1px 1px 1px " + n + ",1px -1px 1px " + n + ",1px 1px 1px " + n)
                }(c = document.createElement("div")).className = "jw-captions jw-reset", this.show = function() {
                    Object(_e.a)(c, "jw-captions-enabled")
                }, this.hide = function() {
                    Object(_e.n)(c, "jw-captions-enabled")
                }, this.populate = function(e) {
                    w.get("renderCaptionsNatively") || (s = [], n = e, e ? this.selectCues(e, l) : this.renderCues())
                }, this.resize = function() {
                    j(), this.renderCues(!0)
                }, this.renderCues = function(e) {
                    e = !!e, Pe && Pe.processCues(window, s, c, e)
                }, this.selectCues = function(e, t) {
                    if (e && e.data && t && !w.get("renderCaptionsNatively")) {
                        var i = this.getAlignmentPosition(e, t);
                        !1 !== i && (s = this.getCurrentCues(e.data, i), this.renderCues(!0))
                    }
                }, this.getCurrentCues = function(e, t) {
                    return Object(r.k)(e, function(e) {
                        return t >= e.startTime && (!e.endTime || t <= e.endTime)
                    })
                }, this.getAlignmentPosition = function(e, t) {
                    var i = e.source,
                        n = t.metadata,
                        o = t.currentTime;
                    return i && n && Object(r.v)(n[i]) && (o = n[i]), o
                }, this.clear = function() {
                    Object(_e.f)(c)
                }, this.setup = function(e, i) {
                    u = document.createElement("div"), d = document.createElement("span"), u.className = "jw-captions-window jw-reset", d.className = "jw-captions-text jw-reset", t = Object(r.j)({}, Re, i), p = Re.fontScale, g(t.fontSize);
                    var n = t.windowColor,
                        o = t.windowOpacity,
                        a = t.edgeStyle;
                    f = {};
                    var s = {};
                    ! function(e, t) {
                        var i = t.color,
                            n = t.fontOpacity;
                        (i || n !== Re.fontOpacity) && (e.color = Object(Ce.c)(i || "#ffffff", n));
                        if (t.back) {
                            var o = t.backgroundColor,
                                a = t.backgroundOpacity;
                            o === Re.backgroundColor && a === Re.backgroundOpacity || (e.backgroundColor = Object(Ce.c)(o, a))
                        } else e.background = "transparent";
                        t.fontFamily && (e.fontFamily = t.fontFamily);
                        t.fontStyle && (e.fontStyle = t.fontStyle);
                        t.fontWeight && (e.fontWeight = t.fontWeight);
                        t.textDecoration && (e.textDecoration = t.textDecoration)
                    }(s, t), (n || o !== Re.windowOpacity) && (f.backgroundColor = Object(Ce.c)(n || "#000000", o)), b(a, s, t.fontOpacity), t.back || null !== a || b("uniform", s), Object(Ce.d)(u, f), Object(Ce.d)(d, s),
                        function(e, t) {
                            j(),
                                function(e, t) {
                                    y.Browser.safari && Object(Ce.b)("#" + e + " .jw-video::-webkit-media-text-track-display-backdrop", {
                                        backgroundColor: t.backgroundColor
                                    }, e, !0);
                                    Object(Ce.b)("#" + e + " .jw-video::-webkit-media-text-track-display", f, e, !0), Object(Ce.b)("#" + e + " .jw-video::cue", t, e, !0)
                                }(e, t),
                                function(e, t) {
                                    Object(Ce.b)("#" + e + " .jw-text-track-display", f, e), Object(Ce.b)("#" + e + " .jw-text-track-cue", t, e)
                                }(e, t)
                        }(e, s), u.appendChild(d), c.appendChild(u), w.change("captionsTrack", function(e, t) {
                            this.populate(t)
                        }, this), w.set("captions", t)
                }, this.element = function() {
                    return c
                }, this.destroy = function() {
                    w.off(null, null, this), this.off()
                };
                var v = function(e) {
                    l = e, h.selectCues(n, l)
                };
                w.on("change:playlistItem", function() {
                    l = null, s = []
                }, this), w.on(a.Q, function(e) {
                    s = [], v(e)
                }, this), w.on(a.S, v, this), w.on("subtitlesTrackData", function() {
                    this.selectCues(n, l)
                }, this), w.on("change:captionsList", function e(t, n) {
                    var r = this;
                    1 !== n.length && (t.get("renderCaptionsNatively") || Pe || (i.e(9).then(function(e) {
                        Pe = i(146).default
                    }.bind(null, i)).catch(Object(o.c)(301121)).catch(function(e) {
                        r.trigger(a.ub, e)
                    }), t.off("change:captionsList", e, this)))
                }, this)
            };
        Object(r.j)(Be.prototype, g.a);
        var He = Be,
            Ve = function(e, t) {
                var i = t ? " jw-hide" : "";
                return '<div class="jw-logo jw-logo-'.concat(e).concat(i, ' jw-reset"></div>')
            },
            Ne = {
                linktarget: "_blank",
                margin: 8,
                hide: !1,
                position: "top-right"
            };

        function qe(e) {
            var t, i;
            Object(r.j)(this, g.a);
            var n = new Image;
            this.setup = function() {
                (i = Object(r.j)({}, Ne, e.get("logo"))).position = i.position || Ne.position, i.hide = "true" === i.hide.toString(), i.file && "control-bar" !== i.position && (t || (t = Object(_e.e)(Ve(i.position, i.hide))), e.set("logo", i), n.onload = function() {
                    var n = this.height,
                        o = this.width,
                        a = {
                            backgroundImage: 'url("' + this.src + '")'
                        };
                    if (i.margin !== Ne.margin) {
                        var r = /(\w+)-(\w+)/.exec(i.position);
                        3 === r.length && (a["margin-" + r[1]] = i.margin, a["margin-" + r[2]] = i.margin)
                    }
                    var s = .15 * e.get("containerHeight"),
                        l = .15 * e.get("containerWidth");
                    if (n > s || o > l) {
                        var c = o / n;
                        l / s > c ? (n = s, o = s * c) : (o = l, n = l / c)
                    }
                    a.width = Math.round(o), a.height = Math.round(n), Object(Ce.d)(t, a), e.set("logoWidth", a.width)
                }, n.src = i.file, i.link && (t.setAttribute("tabindex", "0"), t.setAttribute("aria-label", e.get("localization").logo)), this.ui = new Le.a(t).on("click tap enter", function(e) {
                    e && e.stopPropagation && e.stopPropagation(), this.trigger(a.A, {
                        link: i.link,
                        linktarget: i.linktarget
                    })
                }, this))
            }, this.setContainer = function(e) {
                t && e.appendChild(t)
            }, this.element = function() {
                return t
            }, this.position = function() {
                return i.position
            }, this.destroy = function() {
                n.onload = null, this.ui && this.ui.destroy()
            }
        }
        var Fe = function(e) {
            this.model = e, this.image = null
        };
        Object(r.j)(Fe.prototype, {
            setup: function(e) {
                this.el = e
            },
            setImage: function(e) {
                var t = this.image;
                t && (t.onload = null), this.image = null;
                var i = "";
                "string" == typeof e && (i = 'url("' + e + '")', (t = this.image = new Image).src = e), Object(Ce.d)(this.el, {
                    backgroundImage: i
                })
            },
            resize: function(e, t, i) {
                if ("uniform" === i) {
                    if (e && (this.playerAspectRatio = e / t), !this.playerAspectRatio || !this.image || "complete" !== (s = this.model.get("state")) && "idle" !== s && "error" !== s && "buffering" !== s) return;
                    var n = this.image,
                        o = null;
                    if (n) {
                        if (0 === n.width) {
                            var a = this;
                            return void(n.onload = function() {
                                a.resize(e, t, i)
                            })
                        }
                        var r = n.width / n.height;
                        Math.abs(this.playerAspectRatio - r) < .09 && (o = "cover")
                    }
                    Object(Ce.d)(this.el, {
                        backgroundSize: o
                    })
                }
                var s
            },
            element: function() {
                return this.el
            }
        });
        var De = Fe,
            Ue = function(e) {
                this.model = e.player
            };
        Object(r.j)(Ue.prototype, {
            hide: function() {
                Object(Ce.d)(this.el, {
                    display: "none"
                })
            },
            show: function() {
                Object(Ce.d)(this.el, {
                    display: ""
                })
            },
            setup: function(e) {
                this.el = e;
                var t = this.el.getElementsByTagName("div");
                this.title = t[0], this.description = t[1], this.model.on("change:logoWidth", this.update, this), this.model.change("playlistItem", this.playlistItem, this)
            },
            update: function(e) {
                var t = {},
                    i = e.get("logo");
                if (i) {
                    var n = 1 * ("" + i.margin).replace("px", ""),
                        o = e.get("logoWidth") + (isNaN(n) ? 0 : n + 10);
                    "top-left" === i.position ? t.paddingLeft = o : "top-right" === i.position && (t.paddingRight = o)
                }
                Object(Ce.d)(this.el, t)
            },
            playlistItem: function(e, t) {
                if (t)
                    if (e.get("displaytitle") || e.get("displaydescription")) {
                        var i = "",
                            n = "";
                        t.title && e.get("displaytitle") && (i = t.title), t.description && e.get("displaydescription") && (n = t.description), this.updateText(i, n)
                    } else this.hide()
            },
            updateText: function(e, t) {
                Object(_e.p)(this.title, e), Object(_e.p)(this.description, t), this.title.firstChild || this.description.firstChild ? this.show() : this.hide()
            },
            element: function() {
                return this.el
            }
        });
        var We = Ue;

        function Ze(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
            }
        }
        var Qe, Ye = function() {
            function e(t) {
                ! function(e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }(this, e), this.container = t, this.input = t.querySelector(".jw-media")
            }
            var t, i, n;
            return t = e, (i = [{
                key: "disable",
                value: function() {
                    this.ui && (this.ui.destroy(), this.ui = null)
                }
            }, {
                key: "enable",
                value: function() {
                    var e, t, i, n, o = this.container,
                        a = this.input,
                        r = this.ui = new Le.a(a, {
                            preventScrolling: !0
                        }).on("dragStart", function() {
                            e = o.offsetLeft, t = o.offsetTop, i = window.innerHeight, n = window.innerWidth
                        }).on("drag", function(a) {
                            var s = Math.max(e + a.pageX - r.startX, 0),
                                l = Math.max(t + a.pageY - r.startY, 0),
                                c = Math.max(n - (s + o.clientWidth), 0),
                                u = Math.max(i - (l + o.clientHeight), 0);
                            0 === c ? s = "auto" : c = "auto", 0 === l ? u = "auto" : l = "auto", Object(Ce.d)(o, {
                                left: s,
                                right: c,
                                top: l,
                                bottom: u,
                                margin: 0
                            })
                        }).on("dragEnd", function() {
                            e = t = n = i = null
                        })
                }
            }]) && Ze(t.prototype, i), n && Ze(t, n), e
        }();
        i(106);
        var Ke = y.OS.mobile,
            Xe = y.Browser.ie,
            Je = null;
        var Ge = function(e, t) {
                var i, n, o, s, l = Object(r.j)(this, g.a, {
                        isSetup: !1,
                        api: e,
                        model: t
                    }),
                    c = t.get("localization"),
                    u = Object(_e.e)(ge(t.get("id"), c.player)),
                    d = u.querySelector(".jw-wrapper"),
                    p = u.querySelector(".jw-media"),
                    f = new Ye(d),
                    h = new De(t),
                    j = new We(t),
                    b = new He(t);
                b.on("all", l.trigger, l);
                var v = -1,
                    m = -1,
                    k = -1,
                    x = t.get("floating");
                this.dismissible = x && x.dismissible;
                var O, T, C, S = !1,
                    _ = {},
                    M = null,
                    E = null;

                function A() {
                    Object(Oe.a)(m), m = Object(Oe.b)(L)
                }

                function L() {
                    l.isSetup && (l.updateBounds(), l.updateStyles(), l.checkResized())
                }

                function z(e, i) {
                    if (Object(r.v)(e) && Object(r.v)(i)) {
                        var n = Object(Te.a)(e);
                        Object(Te.b)(u, n);
                        var o = n < 2;
                        Object(_e.u)(u, "jw-flag-small-player", o), Object(_e.u)(u, "jw-orientation-portrait", i > e)
                    }
                    if (t.get("controls")) {
                        var a = ve(t);
                        Object(_e.u)(u, "jw-flag-audio-player", a), t.set("audioMode", a)
                    }
                }

                function P() {
                    t.set("visibility", ye(t, u))
                }

                function I(e, t) {
                    var i = {
                        controls: t
                    };
                    t ? (Qe = Se.a.controls) ? R() : (i.loadPromise = Object(Se.b)().then(function(t) {
                        Qe = t;
                        var i = e.get("controls");
                        return i && R(), i
                    }), i.loadPromise.catch(function(e) {
                        l.trigger(a.ub, e)
                    })) : l.removeControls(), n && o && l.trigger(a.o, i)
                }

                function R() {
                    var e = new Qe(document, l.element());
                    l.addControls(e)
                }

                function B(e, t, i) {
                    t && !i && (G(0, e.get("state")), l.updateStyles())
                }

                function H(e) {
                    E && E.mouseMove(e)
                }

                function V(e) {
                    E && !E.showing && "IFRAME" === e.target.nodeName && E.userActive()
                }

                function N(e) {
                    E && E.showing && (e.relatedTarget && !u.contains(e.relatedTarget) || !e.relatedTarget && y.Features.iframe) && E.userActive()
                }

                function q(e, t) {
                    Object(_e.o)(u, /jw-stretch-\S+/, "jw-stretch-" + t)
                }

                function F(e, t) {
                    Object(_e.u)(u, "jw-flag-aspect-mode", !!t);
                    var i = u.querySelectorAll(".jw-aspect");
                    Object(Ce.d)(i, {
                        paddingTop: t || null
                    })
                }

                function D(i) {
                    i.link ? (e.pause({
                        reason: "interaction"
                    }), e.setFullscreen(!1), Object(_e.k)(i.link, i.linktarget, {
                        rel: "noreferrer"
                    })) : t.get("controls") && e.playToggle({
                        reason: "interaction"
                    })
                }
                this.updateBounds = function() {
                    Object(Oe.a)(m);
                    var e = t.get("isFloating") ? d : u,
                        i = document.body.contains(e),
                        a = Object(_e.c)(e),
                        r = Math.round(a.width),
                        s = Math.round(a.height);
                    if (_ = Object(_e.c)(u), r === n && s === o) return n && o || A(), void t.set("inDom", i);
                    r && s || n && o || A(), (r || s || i) && (t.set("containerWidth", r), t.set("containerHeight", s)), t.set("inDom", i), i && me.a.observe(u)
                }, this.updateStyles = function() {
                    var e = t.get("containerWidth"),
                        i = t.get("containerHeight");
                    z(e, i), E && E.resize(e, i), Z(e, i), b.resize()
                }, this.checkResized = function() {
                    var e = t.get("containerWidth"),
                        i = t.get("containerHeight"),
                        r = t.get("isFloating");
                    if (e !== n || i !== o) {
                        n = e, o = i, l.trigger(a.ib, {
                            width: e,
                            height: i
                        });
                        var c = Object(Te.a)(e);
                        M !== c && (M = c, l.trigger(a.j, {
                            breakpoint: M
                        }))
                    }
                    r !== s && (s = r, l.trigger(a.x, {
                        floating: r
                    }), P())
                }, this.responsiveListener = A, this.setup = function() {
                    var n, o, r, s;
                    h.setup(u.querySelector(".jw-preview")), j.setup(u.querySelector(".jw-title")), (i = new qe(t)).setup(), i.setContainer(d), i.on(a.A, D), b.setup(u.id, t.get("captions")), j.element().parentNode.insertBefore(b.element(), j.element()), n = e, r = new Ie(o = t, p), s = o.get("controls"), r.on({
                        click: function() {
                            l.trigger(a.p), E && (te() ? E.settingsMenu.close() : ie() ? E.infoOverlay.close() : n.playToggle({
                                reason: "interaction"
                            }))
                        },
                        tap: function() {
                            u.removeEventListener("mousemove", H), u.removeEventListener("mouseout", N), u.removeEventListener("mouseover", V), l.trigger(a.p), te() && E.settingsMenu.close(), ie() && E.infoOverlay.close();
                            var e = o.get("state");
                            if (s && (e === a.nb || e === a.lb || o.get("instream") && e === a.pb) && n.playToggle({
                                    reason: "interaction"
                                }), s && e === a.pb) {
                                if (o.get("instream") || o.get("castActive") || "audio" === o.get("mediaType")) return;
                                Object(_e.u)(u, "jw-flag-controls-hidden"), l.dismissible && Object(_e.u)(u, "jw-floating-dismissible", Object(_e.h)(u, "jw-flag-controls-hidden")), b.renderCues(!0)
                            } else E && (E.showing ? E.userInactive() : E.userActive())
                        },
                        doubleClick: function() {
                            return E && n.setFullscreen()
                        }
                    }), u.addEventListener("mousemove", H), u.addEventListener("mouseover", V), u.addEventListener("mouseout", N), O = r, C = new Le.a(u).on("click", function() {}), T = Ae(u, document, Q), t.on("change:hideAdsControls", function(e, t) {
                        Object(_e.u)(u, "jw-flag-ads-hide-controls", t)
                    }), t.on("change:scrubbing", function(e, t) {
                        Object(_e.u)(u, "jw-flag-dragging", t)
                    }), t.on("change:playRejected", function(e, t) {
                        Object(_e.u)(u, "jw-flag-play-rejected", t)
                    }), t.on(a.X, Q), t.on("change:".concat(a.U), function() {
                        Z(), b.resize()
                    }), t.player.on("change:errorEvent", J), t.change("stretching", q);
                    var c = t.get("width"),
                        f = t.get("height"),
                        g = W(c, f);
                    Object(Ce.d)(u, g), t.change("aspectratio", F), z(c, f), t.get("controls") || (Object(_e.a)(u, "jw-flag-controls-hidden"), Object(_e.n)(u, "jw-floating-dismissible")), Xe && Object(_e.a)(u, "jw-ie");
                    var v = t.get("skin") || {};
                    v.name && Object(_e.o)(u, /jw-skin-\S+/, "jw-skin-" + v.name);
                    var m = function(e) {
                        e || (e = {});
                        var t = e.active,
                            i = e.inactive,
                            n = e.background,
                            o = {};
                        return o.controlbar = function(e) {
                            if (e || t || i || n) {
                                var o = {};
                                return e = e || {}, o.iconsActive = e.iconsActive || t, o.icons = e.icons || i, o.text = e.text || i, o.background = e.background || n, o
                            }
                        }(e.controlbar), o.timeslider = function(e) {
                            if (e || t) {
                                var i = {};
                                return e = e || {}, i.progress = e.progress || t, i.rail = e.rail, i
                            }
                        }(e.timeslider), o.menus = function(e) {
                            if (e || t || i || n) {
                                var o = {};
                                return e = e || {}, o.text = e.text || i, o.textActive = e.textActive || t, o.background = e.background || n, o
                            }
                        }(e.menus), o.tooltips = function(e) {
                            if (e || i || n) {
                                var t = {};
                                return e = e || {}, t.text = e.text || i, t.background = e.background || n, t
                            }
                        }(e.tooltips), o
                    }(v);
                    ! function(e, t) {
                        var i;

                        function n(t, i, n, o) {
                            if (n) {
                                t = Object(w.e)(t, "#" + e + (o ? "" : " "));
                                var a = {};
                                a[i] = n, Object(Ce.b)(t.join(", "), a, e)
                            }
                        }
                        t && (t.controlbar && function(t) {
                            n([".jw-controlbar .jw-icon-inline.jw-text", ".jw-title-primary", ".jw-title-secondary"], "color", t.text), t.icons && (n([".jw-button-color:not(.jw-icon-cast)", ".jw-button-color.jw-toggle.jw-off:not(.jw-icon-cast)"], "color", t.icons), n([".jw-display-icon-container .jw-button-color"], "color", t.icons), Object(Ce.b)("#".concat(e, " .jw-icon-cast google-cast-launcher.jw-off"), "{--disconnected-color: ".concat(t.icons, "}"), e)), t.iconsActive && (n([".jw-display-icon-container .jw-button-color:hover", ".jw-display-icon-container .jw-button-color:focus"], "color", t.iconsActive), n([".jw-button-color.jw-toggle:not(.jw-icon-cast)", ".jw-button-color:hover:not(.jw-icon-cast)", ".jw-button-color:focus:not(.jw-icon-cast)", ".jw-button-color.jw-toggle.jw-off:hover:not(.jw-icon-cast)"], "color", t.iconsActive), n([".jw-svg-icon-buffer"], "fill", t.icons), Object(Ce.b)("#".concat(e, " .jw-icon-cast:hover google-cast-launcher.jw-off"), "{--disconnected-color: ".concat(t.iconsActive, "}"), e), Object(Ce.b)("#".concat(e, " .jw-icon-cast:focus google-cast-launcher.jw-off"), "{--disconnected-color: ".concat(t.iconsActive, "}"), e), Object(Ce.b)("#".concat(e, " .jw-icon-cast google-cast-launcher.jw-off:focus"), "{--disconnected-color: ".concat(t.iconsActive, "}"), e), Object(Ce.b)("#".concat(e, " .jw-icon-cast google-cast-launcher"), "{--connected-color: ".concat(t.iconsActive, "}"), e), Object(Ce.b)("#".concat(e, " .jw-icon-cast google-cast-launcher:focus"), "{--connected-color: ".concat(t.iconsActive, "}"), e), Object(Ce.b)("#".concat(e, " .jw-icon-cast:hover google-cast-launcher"), "{--connected-color: ".concat(t.iconsActive, "}"), e), Object(Ce.b)("#".concat(e, " .jw-icon-cast:focus google-cast-launcher"), "{--connected-color: ".concat(t.iconsActive, "}"), e)), n([" .jw-settings-topbar", ":not(.jw-state-idle) .jw-controlbar", ".jw-flag-audio-player .jw-controlbar"], "background", t.background, !0)
                        }(t.controlbar), t.timeslider && (n([".jw-progress", ".jw-knob"], "background-color", (i = t.timeslider).progress), n([".jw-buffer"], "background-color", Object(Ce.c)(i.progress, 50)), n([".jw-rail"], "background-color", i.rail), n([".jw-background-color.jw-slider-time", ".jw-slider-time .jw-cue"], "background-color", i.background)), t.menus && function(e) {
                            n([".jw-option", ".jw-toggle.jw-off", ".jw-skip .jw-skip-icon", ".jw-nextup-tooltip", ".jw-nextup-close", ".jw-settings-content-item", ".jw-related-title"], "color", e.text), n([".jw-option.jw-active-option", ".jw-option:not(.jw-active-option):hover", ".jw-option:not(.jw-active-option):focus", ".jw-settings-content-item:hover", ".jw-nextup-tooltip:hover", ".jw-nextup-tooltip:focus", ".jw-nextup-close:hover"], "color", e.textActive), n([".jw-nextup", ".jw-settings-menu"], "background", e.background)
                        }(t.menus), t.tooltips && function(e) {
                            n([".jw-skip", ".jw-tooltip .jw-text", ".jw-time-tip .jw-text"], "background-color", e.background), n([".jw-time-tip", ".jw-tooltip"], "color", e.background), n([".jw-skip"], "border", "none"), n([".jw-skip .jw-text", ".jw-skip .jw-icon", ".jw-time-tip .jw-text", ".jw-tooltip .jw-text"], "color", e.text)
                        }(t.tooltips), t.menus && function(t) {
                            if (t.textActive) {
                                var i = {
                                    color: t.textActive,
                                    borderColor: t.textActive,
                                    stroke: t.textActive
                                };
                                Object(Ce.b)("#".concat(e, " .jw-color-active"), i, e), Object(Ce.b)("#".concat(e, " .jw-color-active-hover:hover"), i, e)
                            }
                            if (t.text) {
                                var n = {
                                    color: t.text,
                                    borderColor: t.text,
                                    stroke: t.text
                                };
                                Object(Ce.b)("#".concat(e, " .jw-color-inactive"), n, e), Object(Ce.b)("#".concat(e, " .jw-color-inactive-hover:hover"), n, e)
                            }
                        }(t.menus))
                    }(t.get("id"), m), t.set("mediaContainer", p), t.set("iFrame", y.Features.iframe), t.set("activeTab", Object(xe.a)()), t.set("touchMode", Ke && ("string" == typeof f || f >= be)), me.a.add(this), t.get("enableGradient") && !Xe && Object(_e.a)(u, "jw-ab-drop-shadow"), this.isSetup = !0, t.trigger("viewSetup", u);
                    var k = document.body.contains(u);
                    k && me.a.observe(u), t.set("inDom", k)
                }, this.init = function() {
                    this.updateBounds(), t.on("change:fullscreen", U), t.on("change:activeTab", P), t.on("change:fullscreen", P), t.on("change:intersectionRatio", P), t.on("change:visibility", B), t.on("instreamMode", function(e) {
                        e ? ne() : oe()
                    }), P(), 1 !== me.a.size() || t.get("visibility") || B(t, 1, 0);
                    var e = t.player;
                    t.change("state", G), e.change("controls", I), t.change("streamType", K), t.change("mediaType", X), e.change("playlistItem", ee), n = o = null, this.checkResized()
                }, this.addControls = function(i) {
                    var r = this;
                    E = i, Object(_e.n)(u, "jw-flag-controls-hidden"), Object(_e.u)(u, "jw-floating-dismissible", this.dismissible), i.enable(e, t), o && (z(n, o), i.resize(n, o), b.renderCues(!0)), i.on("userActive userInactive", function() {
                        var e = t.get("state");
                        e !== a.qb && e !== a.kb || b.renderCues(!0)
                    }), i.on("dismissFloating", function() {
                        r.stopFloating(!0), e.pause({
                            reason: "interaction"
                        })
                    }), i.on("all", l.trigger, l), t.get("instream") && E.setupInstream()
                }, this.removeControls = function() {
                    E && (E.disable(t), E = null), Object(_e.a)(u, "jw-flag-controls-hidden"), Object(_e.n)(u, "jw-floating-dismissible")
                };
                var U = function(t, i) {
                    if (i && E && t.get("autostartMuted") && E.unmuteAutoplay(e, t), T.supportsDomFullscreen()) i ? T.requestFullscreen() : T.exitFullscreen(), Y(u, i);
                    else if (Xe) Y(u, i);
                    else {
                        var n = t.get("instream"),
                            o = n ? n.provider : null,
                            a = t.getVideo() || o;
                        a && a.setFullscreen && a.setFullscreen(i)
                    }
                };

                function W(e, i, n) {
                    var o = {
                        width: e
                    };
                    if (n && void 0 !== i && t.set("aspectratio", null), !t.get("aspectratio")) {
                        var a = i;
                        Object(r.v)(a) && 0 !== a && (a = Math.max(a, be)), o.height = a
                    }
                    return o
                }

                function Z(e, i) {
                    if ((e && !isNaN(1 * e) || (e = t.get("containerWidth"))) && (i && !isNaN(1 * i) || (i = t.get("containerHeight")))) {
                        h && h.resize(e, i, t.get("stretching"));
                        var n = t.getVideo();
                        n && n.resize(e, i, t.get("stretching"))
                    }
                }

                function Q(e) {
                    var i = t.get("fullscreen"),
                        n = void 0 !== e.jwstate ? e.jwstate : function() {
                            if (T.supportsDomFullscreen()) {
                                var e = T.fullscreenElement();
                                return !(!e || e !== u)
                            }
                            return t.getVideo().getFullScreen()
                        }();
                    i !== n && t.set("fullscreen", n), A(), clearTimeout(v), v = setTimeout(Z, 200)
                }

                function Y(e, t) {
                    Object(_e.u)(e, "jw-flag-fullscreen", t), Object(Ce.d)(document.body, {
                        overflowY: t ? "hidden" : ""
                    }), t && E && E.userActive(), Z(), A()
                }

                function K(e, t) {
                    var i = "LIVE" === t;
                    Object(_e.u)(u, "jw-flag-live", i)
                }

                function X(e, t) {
                    var i = "audio" === t,
                        n = e.get("provider");
                    Object(_e.u)(u, "jw-flag-media-audio", i);
                    var o = n && 0 === n.name.indexOf("flash"),
                        a = i && !o ? p : p.nextSibling;
                    h.el.parentNode.insertBefore(h.el, a)
                }

                function J(e, t) {
                    if (t) {
                        var i = Object(je.a)(e, t);
                        je.a.cloneIcon && i.querySelector(".jw-icon").appendChild(je.a.cloneIcon("error")), j.hide(), u.appendChild(i.firstChild), Object(_e.u)(u, "jw-flag-audio-player", !!e.get("audioMode"))
                    } else j.playlistItem(e, e.get("playlistItem"))
                }

                function G(e, t, i) {
                    if (l.isSetup) {
                        if (i === a.mb) {
                            var n = u.querySelector(".jw-error-msg");
                            n && n.parentNode.removeChild(n)
                        }
                        Object(Oe.a)(k), t === a.qb ? $(t) : k = Object(Oe.b)(function() {
                            return $(t)
                        })
                    }
                }

                function $(e) {
                    switch (t.get("controls") && e !== a.pb && Object(_e.h)(u, "jw-flag-controls-hidden") && (Object(_e.n)(u, "jw-flag-controls-hidden"), Object(_e.u)(u, "jw-floating-dismissible", l.dismissible)), Object(_e.o)(u, /jw-state-\S+/, "jw-state-" + e), e) {
                        case a.mb:
                            l.stopFloating();
                        case a.nb:
                        case a.lb:
                            b && b.hide();
                            break;
                        default:
                            b && (b.show(), e === a.pb && E && !E.showing && b.renderCues(!0))
                    }
                }

                function ee(e, t) {
                    ! function(e) {
                        h.setImage(e && e.image)
                    }(t), Ke && function(e, t) {
                        var i = e.get("mediaElement");
                        if (i) {
                            var n = Object(_e.i)(t.title || "");
                            i.setAttribute("title", n.textContent)
                        }
                    }(e, t)
                }
                this.resize = function(e, i) {
                    var n = W(e, i, !0);
                    void 0 !== e && void 0 !== i && (t.set("width", e), t.set("height", i)), Object(Ce.d)(u, n), t.get("isFloating") && ae(), L()
                }, this.resizeMedia = Z;
                var te = function() {
                        var e = E && E.settingsMenu;
                        return !(!e || !e.visible)
                    },
                    ie = function() {
                        var e = E && E.infoOverlay;
                        return !(!e || !e.visible)
                    },
                    ne = function() {
                        Object(_e.a)(u, "jw-flag-ads"), E && E.setupInstream(), f.disable()
                    },
                    oe = function() {
                        if (O) {
                            E && E.destroyInstream(t), Je !== u || Object(Me.m)() || f.enable(), l.setAltText(""), Object(_e.n)(u, ["jw-flag-ads", "jw-flag-ads-hide-controls"]), t.set("hideAdsControls", !1);
                            var e = t.getVideo();
                            e && e.setContainer(p), O.revertAlternateClickHandlers()
                        }
                    };

                function ae() {
                    var e = t.get("width"),
                        i = t.get("height"),
                        n = W(e);
                    if (n.maxWidth = Math.min(400, _.width), !t.get("aspectratio")) {
                        var o = _.width,
                            a = _.height / o || .5625;
                        Object(r.v)(e) && Object(r.v)(i) && (a = i / e), F(0, 100 * a + "%")
                    }
                    Object(Ce.d)(d, n)
                }
                this.setAltText = function(e) {
                    t.set("altText", e)
                }, this.clickHandler = function() {
                    return O
                }, this.getContainer = this.element = function() {
                    return u
                }, this.getWrapper = function() {
                    return d
                }, this.controlsContainer = function() {
                    return E ? E.element() : null
                }, this.getSafeRegion = function() {
                    var e = !(arguments.length > 0 && void 0 !== arguments[0]) || arguments[0],
                        t = {
                            x: 0,
                            y: 0,
                            width: n || 0,
                            height: o || 0
                        };
                    return E && e && (t.height -= E.controlbarHeight()), t
                }, this.setCaptions = function(e) {
                    b.clear(), b.setup(t.get("id"), e), b.resize()
                }, this.setIntersection = function(e) {
                    var i = Math.round(100 * e.intersectionRatio) / 100;
                    t.set("intersectionRatio", i), x && (S = S || i >= .5) && function(e) {
                        if (e < .5 && !Object(Me.m)()) {
                            var i = t.get("state");
                            i !== a.nb && i !== a.mb && i !== a.lb && null === Je && (Je = u, t.set("isFloating", !0), Object(_e.a)(u, "jw-flag-floating"), Object(Ce.d)(u, {
                                backgroundImage: h.el.style.backgroundImage || t.get("image")
                            }), ae(), t.get("instreamMode") || f.enable(), A())
                        } else l.stopFloating()
                    }(i)
                }, this.stopFloating = function(e) {
                    e && (x = null), Je === u && (Je = null, t.set("isFloating", !1), Object(_e.n)(u, "jw-flag-floating"), F(0, t.get("aspectratio")), Object(Ce.d)(u, {
                        backgroundImage: null
                    }), Object(Ce.d)(d, {
                        maxWidth: null,
                        width: null,
                        height: null,
                        left: null,
                        right: null,
                        top: null,
                        bottom: null,
                        margin: null
                    }), f.disable(), A())
                }, this.destroy = function() {
                    t.destroy(), me.a.unobserve(u), me.a.remove(this), this.isSetup = !1, this.off(), Object(Oe.a)(m), clearTimeout(v), Je === u && (Je = null), C && (C.destroy(), C = null), T && (T.destroy(), T = null), E && E.disable(t), O && (O.destroy(), u.removeEventListener("mousemove", H), u.removeEventListener("mouseout", N), u.removeEventListener("mouseover", V), O = null), b.destroy(), i && (i.destroy(), i = null), Object(Ce.a)(t.get("id"))
                }
            },
            $e = !1,
            et = function(e, t) {
                this.playerElement = e, this.wrapperElement = t
            };
        Object(r.j)(et.prototype, {
            setup: function(e) {
                var t = Object(_e.e)(function(e) {
                    return '<span class="jw-text jw-reset">'.concat(e, "</span>")
                }(e));
                this.wrapperElement.appendChild(t), Object(_e.a)(this.playerElement, "jw-flag-top")
            }
        });
        var tt = et,
            it = function(e, t) {
                var n = new Ge(e, t),
                    o = n.setup;
                n.setup = function() {
                    var e = this;
                    o.call(this), t.get("displayHeading") && new tt(n.getContainer(), n.getContainer().querySelector(".jw-top")).setup(t.get("localization").advertising.displayHeading), t.change("castAvailable", function(t, i) {
                        var n = t.get("cast");
                        Object(n) === n && Object(_e.u)(e.getContainer(), "jw-flag-cast-available", i)
                    }, this), t.change("castActive", function(t, i) {
                        var n = t.get("airplayActive");
                        Object(_e.u)(e.getContainer(), "jw-flag-casting", i || !1), Object(_e.u)(e.getContainer(), "jw-flag-airplay-casting", n || !1)
                    }, this), t.change("flashBlocked", function(t, i) {
                        Object(_e.u)(e.getContainer(), "jw-flag-flash-blocked", i)
                    }, this)
                };
                var r = t.get("advertising");
                return r && r.outstream && function(e, t) {
                    $e || ($e = !0, i(108));
                    var n = t.model,
                        o = t.getSafeRegion;
                    t.getSafeRegion = function(e) {
                        var t = o.call(this, e);
                        return t.height = this.api.getHeight(), t
                    }, n.on("change:mediaState", function(e, i) {
                        i !== a.ob && i !== a.qb || (n.off("change:mediaState", null, t), Object(_e.n)(t.getContainer(), "jw-flag-outstream-pending"), t.getSafeRegion = o, t.responsiveListener())
                    }, t);
                    var r = t.setup;
                    t.setup = function() {
                        r.call(this), Object(_e.a)(this.getContainer(), "jw-flag-outstream jw-flag-outstream-pending")
                    };
                    var s = n.get("advertising");
                    s.dismissible && (t.dismissible = !0, t.on("dismissFloating", function() {
                        e.remove()
                    })), e.once(a.cb, function() {
                        t.stopFloating(!0), "close" === s.endstate && Object(_e.a)(t.getContainer(), "jw-flag-outstream-close")
                    })
                }(e, n), n
            };

        function nt(e, t, i) {
            return (nt = "undefined" != typeof Reflect && Reflect.get ? Reflect.get : function(e, t, i) {
                var n = function(e, t) {
                    for (; !Object.prototype.hasOwnProperty.call(e, t) && null !== (e = ct(e)););
                    return e
                }(e, t);
                if (n) {
                    var o = Object.getOwnPropertyDescriptor(n, t);
                    return o.get ? o.get.call(i) : o.value
                }
            })(e, t, i || e)
        }

        function ot(e) {
            return (ot = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            } : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            })(e)
        }

        function at(e, t) {
            if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
        }

        function rt(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
            }
        }

        function st(e, t, i) {
            return t && rt(e.prototype, t), i && rt(e, i), e
        }

        function lt(e, t) {
            return !t || "object" !== ot(t) && "function" != typeof t ? pt(e) : t
        }

        function ct(e) {
            return (ct = Object.setPrototypeOf ? Object.getPrototypeOf : function(e) {
                return e.__proto__ || Object.getPrototypeOf(e)
            })(e)
        }

        function ut(e, t) {
            if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function");
            e.prototype = Object.create(t && t.prototype, {
                constructor: {
                    value: e,
                    writable: !0,
                    configurable: !0
                }
            }), t && dt(e, t)
        }

        function dt(e, t) {
            return (dt = Object.setPrototypeOf || function(e, t) {
                return e.__proto__ = t, e
            })(e, t)
        }

        function pt(e) {
            if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
            return e
        }
        var ft = /^change:(.+)$/;

        function ht(e, t, i) {
            Object.keys(t).forEach(function(n) {
                n in t && t[n] !== i[n] && e.trigger("change:".concat(n), e, t[n], i[n])
            })
        }

        function wt(e, t) {
            e && e.off(null, null, t)
        }
        var gt = function(e) {
                function t(e, i) {
                    var n;
                    return at(this, t), (n = lt(this, ct(t).call(this)))._model = e, n._mediaModel = null, Object(r.j)(e.attributes, {
                        altText: "",
                        fullscreen: !1,
                        logoWidth: 0,
                        scrubbing: !1
                    }), e.on("all", function(t, o, a, r) {
                        o === e && (o = pt(pt(n))), i && !i(t, o, a, r) || n.trigger(t, o, a, r)
                    }, pt(pt(n))), e.on("change:mediaModel", function(e, t) {
                        n.mediaModel = t
                    }, pt(pt(n))), n
                }
                return ut(t, k["a"]), st(t, [{
                    key: "get",
                    value: function(e) {
                        var t = this._mediaModel;
                        return t && e in t.attributes ? t.get(e) : this._model.get(e)
                    }
                }, {
                    key: "set",
                    value: function(e, t) {
                        return this._model.set(e, t)
                    }
                }, {
                    key: "getVideo",
                    value: function() {
                        return this._model.getVideo()
                    }
                }, {
                    key: "destroy",
                    value: function() {
                        wt(this._model, this), wt(this._mediaModel, this), this.off()
                    }
                }, {
                    key: "mediaModel",
                    set: function(e) {
                        var t = this,
                            i = this._mediaModel;
                        wt(i, this), this._mediaModel = e, e.on("all", function(i, n, o, a) {
                            n === e && (n = t), t.trigger(i, n, o, a)
                        }, this), i && ht(this, e.attributes, i.attributes)
                    }
                }]), t
            }(),
            jt = function(e) {
                function t(e) {
                    var i;
                    return at(this, t), (i = lt(this, ct(t).call(this, e, function(e) {
                        var t = i._instreamModel;
                        if (t) {
                            var n = ft.exec(e);
                            if (n)
                                if (n[1] in t.attributes) return !1
                        }
                        return !0
                    })))._instreamModel = null, i._playerViewModel = new gt(i._model), e.on("change:instream", function(e, t) {
                        i.instreamModel = t ? t.model : null
                    }, pt(pt(i))), i
                }
                return ut(t, gt), st(t, [{
                    key: "get",
                    value: function(e) {
                        var t = this._mediaModel;
                        if (t && e in t.attributes) return t.get(e);
                        var i = this._instreamModel;
                        return i && e in i.attributes ? i.get(e) : this._model.get(e)
                    }
                }, {
                    key: "getVideo",
                    value: function() {
                        var e = this._instreamModel;
                        return e && e.getVideo() ? e.getVideo() : nt(ct(t.prototype), "getVideo", this).call(this)
                    }
                }, {
                    key: "destroy",
                    value: function() {
                        nt(ct(t.prototype), "destroy", this).call(this), wt(this._instreamModel, this)
                    }
                }, {
                    key: "player",
                    get: function() {
                        return this._playerViewModel
                    }
                }, {
                    key: "instreamModel",
                    set: function(e) {
                        var t = this,
                            i = this._instreamModel;
                        if (wt(i, this), this._model.off("change:mediaModel", null, this), this._instreamModel = e, this.trigger("instreamMode", !!e), e) e.on("all", function(i, n, o, a) {
                            n === e && (n = t), t.trigger(i, n, o, a)
                        }, this), e.change("mediaModel", function(e, i) {
                            t.mediaModel = i
                        }, this), ht(this, e.attributes, this._model.attributes);
                        else if (i) {
                            this._model.change("mediaModel", function(e, i) {
                                t.mediaModel = i
                            }, this);
                            var n = Object(r.j)({}, this._model.attributes, i.attributes);
                            ht(this, this._model.attributes, n)
                        }
                    }
                }]), t
            }();
        var bt, vt, mt = i(72),
            yt = (bt = window).URL && bt.URL.createObjectURL ? bt.URL : bt.webkitURL || bt.mozURL;

        function kt(e, t) {
            var i = t.muted;
            return vt || (vt = new Blob([new Uint8Array([0, 0, 0, 28, 102, 116, 121, 112, 105, 115, 111, 109, 0, 0, 2, 0, 105, 115, 111, 109, 105, 115, 111, 50, 109, 112, 52, 49, 0, 0, 0, 8, 102, 114, 101, 101, 0, 0, 2, 239, 109, 100, 97, 116, 33, 16, 5, 32, 164, 27, 255, 192, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 55, 167, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 112, 33, 16, 5, 32, 164, 27, 255, 192, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 55, 167, 128, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 112, 0, 0, 2, 194, 109, 111, 111, 118, 0, 0, 0, 108, 109, 118, 104, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 232, 0, 0, 0, 47, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 0, 1, 236, 116, 114, 97, 107, 0, 0, 0, 92, 116, 107, 104, 100, 0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 47, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 36, 101, 100, 116, 115, 0, 0, 0, 28, 101, 108, 115, 116, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 47, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 100, 109, 100, 105, 97, 0, 0, 0, 32, 109, 100, 104, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 172, 68, 0, 0, 8, 0, 85, 196, 0, 0, 0, 0, 0, 45, 104, 100, 108, 114, 0, 0, 0, 0, 0, 0, 0, 0, 115, 111, 117, 110, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 83, 111, 117, 110, 100, 72, 97, 110, 100, 108, 101, 114, 0, 0, 0, 1, 15, 109, 105, 110, 102, 0, 0, 0, 16, 115, 109, 104, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 36, 100, 105, 110, 102, 0, 0, 0, 28, 100, 114, 101, 102, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 12, 117, 114, 108, 32, 0, 0, 0, 1, 0, 0, 0, 211, 115, 116, 98, 108, 0, 0, 0, 103, 115, 116, 115, 100, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 87, 109, 112, 52, 97, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 16, 0, 0, 0, 0, 172, 68, 0, 0, 0, 0, 0, 51, 101, 115, 100, 115, 0, 0, 0, 0, 3, 128, 128, 128, 34, 0, 2, 0, 4, 128, 128, 128, 20, 64, 21, 0, 0, 0, 0, 1, 244, 0, 0, 1, 243, 249, 5, 128, 128, 128, 2, 18, 16, 6, 128, 128, 128, 1, 2, 0, 0, 0, 24, 115, 116, 116, 115, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 2, 0, 0, 4, 0, 0, 0, 0, 28, 115, 116, 115, 99, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 2, 0, 0, 0, 1, 0, 0, 0, 28, 115, 116, 115, 122, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 1, 115, 0, 0, 1, 116, 0, 0, 0, 20, 115, 116, 99, 111, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 44, 0, 0, 0, 98, 117, 100, 116, 97, 0, 0, 0, 90, 109, 101, 116, 97, 0, 0, 0, 0, 0, 0, 0, 33, 104, 100, 108, 114, 0, 0, 0, 0, 0, 0, 0, 0, 109, 100, 105, 114, 97, 112, 112, 108, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 45, 105, 108, 115, 116, 0, 0, 0, 37, 169, 116, 111, 111, 0, 0, 0, 29, 100, 97, 116, 97, 0, 0, 0, 1, 0, 0, 0, 0, 76, 97, 118, 102, 53, 54, 46, 52, 48, 46, 49, 48, 49])], {
                type: "video/mp4"
            })), e.muted = i, e.src = yt.createObjectURL(vt), e.play() || Object(mt.a)(e)
        }
        var xt = "autoplayEnabled",
            Ot = "autoplayMuted",
            Tt = "autoplayDisabled",
            Ct = {};
        var St = i(70),
            _t = i(31),
            Mt = "tabHidden",
            Et = "tabVisible",
            At = function(e) {
                var t = 0;
                return function(i) {
                    var n = i.position;
                    n > t && e(), t = n
                }
            };

        function Lt(e, t) {
            t.off(a.N, e._onPlayAttempt), t.off(a.gb, e._triggerFirstFrame), t.off(a.S, e._onTime), e.off("change:activeTab", e._onTabVisible)
        }
        var zt = function(e, t) {
            e.change("mediaModel", function(e, i, n) {
                e._qoeItem && n && e._qoeItem.end(n.get("mediaState")), e._qoeItem = new _t.a, e._qoeItem.getFirstFrame = function() {
                        var e = this.between(a.N, a.H),
                            t = this.between(Et, a.H);
                        return t > 0 && t < e ? t : e
                    }, e._qoeItem.tick(a.db), e._qoeItem.start(i.get("mediaState")),
                    function(e, t) {
                        e._onTabVisible && Lt(e, t);
                        var i = !1;
                        e._triggerFirstFrame = function() {
                            if (!i) {
                                i = !0;
                                var n = e._qoeItem;
                                n.tick(a.H);
                                var o = n.getFirstFrame();
                                if (t.trigger(a.H, {
                                        loadTime: o
                                    }), t.mediaController) {
                                    var r = t.mediaController.mediaModel;
                                    r.off("change:".concat(a.U), null, r), r.change(a.U, function(e, i) {
                                        i && t.trigger(a.U, i)
                                    }, r)
                                }
                                Lt(e, t)
                            }
                        }, e._onTime = At(e._triggerFirstFrame), e._onPlayAttempt = function() {
                            e._qoeItem.tick(a.N)
                        }, e._onTabVisible = function(t, i) {
                            i ? e._qoeItem.tick(Et) : e._qoeItem.tick(Mt)
                        }, e.on("change:activeTab", e._onTabVisible), t.on(a.N, e._onPlayAttempt), t.once(a.gb, e._triggerFirstFrame), t.on(a.S, e._onTime)
                    }(e, t), i.on("change:mediaState", function(t, i, n) {
                        i !== n && (e._qoeItem.end(n), e._qoeItem.start(i))
                    })
            })
        };

        function Pt(e) {
            return (Pt = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            } : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            })(e)
        }
        var It = function() {},
            Rt = function() {};

        function Bt(e) {
            return e && /^(?:mouse|pointer|touch|gesture|click|key)/.test(e.type)
        }
        Object(r.j)(It.prototype, {
            setup: function(e, t, i, n, o, w) {
                var j, m, k, x, O = this,
                    T = this,
                    C = T._model = new I,
                    S = !1,
                    _ = !1,
                    M = null,
                    E = b(N),
                    A = b(Rt);
                T.originalContainer = T.currentContainer = i, T._events = n, T.trigger = function(e, t) {
                    var i = function(e, t, i) {
                        var n = i;
                        switch (t) {
                            case "time":
                            case "beforePlay":
                            case "pause":
                            case "play":
                            case "ready":
                                var o = e.get("viewable");
                                void 0 !== o && (n = Object(r.j)({}, i, {
                                    viewable: o
                                }))
                        }
                        return n
                    }(C, e, t);
                    return g.a.trigger.call(this, e, i)
                };
                var L = new u.a(T, ["trigger"], function() {
                        return !0
                    }),
                    z = function(e, t) {
                        T.trigger(e, t)
                    };
                C.setup(e);
                var P = C.get("backgroundLoading"),
                    R = new jt(C);
                (j = this._view = new it(t, R)).on("all", function(e, t) {
                    t && t.doNotForward || z(e, t)
                }, T);
                var B = this._programController = new K(C, w);
                le(), B.on("all", z, T).on("subtitlesTracks", function(e) {
                    m.setSubtitlesTracks(e.tracks);
                    var t = m.getCurrentIndex();
                    t > 0 && ae(t)
                }, T).on(a.F, function() {
                    Promise.resolve().then(oe)
                }, T).on(a.G, T.triggerError, T), zt(C, B), C.on(a.w, T.triggerError, T), C.on("change:state", function(e, t, i) {
                    Z() || J.call(O, e, t, i)
                }, this), C.on("change:castState", function(e, t) {
                    T.trigger(a.m, t)
                }), C.on("change:fullscreen", function(e, t) {
                    T.trigger(a.y, {
                        fullscreen: t
                    }), t && e.set("playOnViewable", !1)
                }), C.on("change:volume", function(e, t) {
                    T.trigger(a.V, {
                        volume: t
                    })
                }), C.on("change:mute", function(e) {
                    T.trigger(a.M, {
                        mute: e.getMute()
                    })
                }), C.on("change:playbackRate", function(e, t) {
                    T.trigger(a.ab, {
                        playbackRate: t,
                        position: e.get("position")
                    })
                });
                var H = function e(t, i) {
                    "clickthrough" !== i && "interaction" !== i && "external" !== i || (C.set("playOnViewable", !1), C.off("change:playReason change:pauseReason", e))
                };

                function V(e, t) {
                    Object(r.y)(t) || C.set("viewable", Math.round(t))
                }

                function N() {
                    ce && (!0 !== C.get("autostart") || C.get("playOnViewable") || G("autostart"), ce.flush())
                }

                function q(e, t) {
                    T.trigger("viewable", {
                        viewable: t
                    }), F()
                }

                function F() {
                    if ((s.a[0] === t || 1 === C.get("viewable")) && "idle" === C.get("state") && !1 === C.get("autostart"))
                        if (!w.primed() && y.OS.android) {
                            var e = w.getTestElement(),
                                i = T.getMute();
                            Promise.resolve().then(function() {
                                return kt(e, {
                                    muted: i
                                })
                            }).then(function() {
                                "idle" === C.get("state") && B.preloadVideo()
                            }).catch(Rt)
                        } else B.preloadVideo()
                }

                function D(e, t) {
                    if (e.get("playOnViewable"))
                        if (t) {
                            e.get("state") === a.nb ? G("viewable") : Y({
                                reason: "viewable"
                            })
                        } else y.OS.mobile && !Z() && (T.pause({
                            reason: "autostart"
                        }), C.set("playOnViewable", !0))
                }

                function U(e) {
                    e || (T.pause({
                        reason: "viewable"
                    }), C.set("playOnViewable", !e))
                }

                function W(e, t) {
                    var i = e.get("state"),
                        n = Z(),
                        o = e.get("playReason");
                    n ? (T._instreamAdapter.noResume = !t, t || ee({
                        reason: "viewable"
                    })) : i === a.qb || i === a.kb ? U(t) : i === a.nb && "playlist" === o && e.once("change:state", function() {
                        U(t)
                    })
                }

                function Z() {
                    var e = T._instreamAdapter;
                    return !!e && e.getState()
                }

                function Q() {
                    var e = Z();
                    return e || C.get("state")
                }

                function Y(e) {
                    if (E.cancel(), _ = !1, C.get("state") === a.mb) return Promise.resolve();
                    var i = X(e);
                    C.set("playReason", i);
                    var n = Z(),
                        o = C.get("pauseReason");
                    return n && "viewable" === o && "interaction" !== i ? void 0 : n ? (t.pauseAd(!1, e), Promise.resolve()) : (C.get("state") === a.lb && ($(!0), T.setItemIndex(0)), !S && (S = !0, T.trigger(a.C, {
                        playReason: i,
                        startTime: e && e.startTime ? e.startTime : C.get("playlistItem").starttime
                    }), S = !1, Bt(window.event) && !w.primed() && w.prime(), "playlist" === i && W(C, C.get("viewable")), x) ? (Bt(window.event) && !P && C.get("mediaElement").load(), x = !1, k = null, Promise.resolve()) : B.playVideo(i).then(w.played))
                }

                function X(e) {
                    return e && e.reason ? e.reason : Bt(window.event) ? "interaction" : "external"
                }

                function G(e) {
                    if (Q() === a.nb) {
                        E = b(N);
                        var t = C.get("advertising");
                        (function(e, t) {
                            var i = t.cancelable,
                                n = t.muted,
                                o = void 0 !== n && n,
                                a = t.allowMuted,
                                r = void 0 !== a && a,
                                s = t.timeout,
                                l = void 0 === s ? 1e4 : s,
                                c = e.getTestElement(),
                                u = o ? "muted" : "".concat(r);
                            Ct[u] || (Ct[u] = kt(c, {
                                muted: o
                            }).catch(function(e) {
                                if (!i.cancelled() && !1 === o && r) return kt(c, {
                                    muted: o = !0
                                });
                                throw e
                            }).then(function() {
                                return o ? (Ct[u] = null, Ot) : xt
                            }).catch(function(e) {
                                throw clearTimeout(d), Ct[u] = null, e.reason = Tt, e
                            }));
                            var d, p = Ct[u].then(function(e) {
                                    if (clearTimeout(d), i.cancelled()) {
                                        var t = new Error("Autoplay test was cancelled");
                                        throw t.reason = "cancelled", t
                                    }
                                    return e
                                }),
                                f = new Promise(function(e, t) {
                                    d = setTimeout(function() {
                                        Ct[u] = null;
                                        var e = new Error("Autoplay test timed out");
                                        e.reason = "timeout", t(e)
                                    }, l)
                                });
                            return Promise.race([p, f])
                        })(w, {
                            cancelable: E,
                            muted: T.getMute(),
                            allowMuted: !t || t.autoplayadsmuted
                        }).then(function(t) {
                            return C.set("canAutoplay", t), t !== Ot || T.getMute() || (C.set("autostartMuted", !0), le(), C.once("change:autostartMuted", function(e) {
                                e.off("change:viewable", D), T.trigger(a.M, {
                                    mute: C.getMute()
                                })
                            })), T.getMute() && C.get("enableDefaultCaptions") && m.selectDefaultIndex(1), Y({
                                reason: e
                            }).catch(function() {
                                T._instreamAdapter || C.set("autostartFailed", !0), k = null
                            })
                        }).catch(function(e) {
                            if (C.set("canAutoplay", Tt), C.set("autostart", !1), !E.cancelled()) {
                                var t = Object(v.B)(e);
                                T.trigger(a.h, {
                                    reason: e.reason,
                                    code: t,
                                    error: e
                                })
                            }
                        })
                    }
                }

                function $(e) {
                    if (E.cancel(), ce.empty(), Z()) {
                        var t = T._instreamAdapter;
                        return t && (t.noResume = !0), void(k = function() {
                            return B.stopVideo()
                        })
                    }
                    k = null, !e && (_ = !0), S && (x = !0), C.set("errorEvent", void 0), B.stopVideo()
                }

                function ee(e) {
                    var t = X(e);
                    C.set("pauseReason", t), C.set("playOnViewable", "viewable" === t)
                }

                function te(e) {
                    k = null, E.cancel();
                    var i = Z();
                    if (i && i !== a.pb) return ee(e), void t.pauseAd(!0, e);
                    switch (C.get("state")) {
                        case a.mb:
                            return;
                        case a.qb:
                        case a.kb:
                            ee(e), B.pause();
                            break;
                        default:
                            S && (x = !0)
                    }
                }

                function ie(e, t) {
                    $(!0), T.setItemIndex(e), T.play(t)
                }

                function ne(e) {
                    ie(C.get("item") + 1, e)
                }

                function oe() {
                    var e;
                    (e = C.get("state")) !== a.nb && e !== a.lb && e !== a.mb || (_ ? _ = !1 : (k = oe, C.get("item") !== C.get("playlist").length - 1 ? T.nextItem() : C.get("repeat") ? ne({
                        reason: "repeat"
                    }) : (y.OS.iOS && se(!1), C.set("playOnViewable", !1), C.set("state", a.lb), T.trigger(a.cb, {}))))
                }

                function ae(e) {
                    e = parseInt(e, 10) || 0, C.persistVideoSubtitleTrack(e), B.subtitles = e, T.trigger(a.k, {
                        tracks: re(),
                        track: e
                    })
                }

                function re() {
                    return m.getCaptionsList()
                }

                function se(e) {
                    Object(r.r)(e) || (e = !C.get("fullscreen")), C.set("fullscreen", e), T._instreamAdapter && T._instreamAdapter._adModel && T._instreamAdapter._adModel.set("fullscreen", e)
                }

                function le() {
                    B.mute = C.getMute(), B.volume = C.get("volume")
                }
                C.on("change:playReason change:pauseReason", H), T.on(a.c, function(e) {
                    return H(0, e.playReason)
                }), T.on(a.b, function(e) {
                    return H(0, e.pauseReason)
                }), C.on("change:scrubbing", function(e, t) {
                    t ? (M = C.get("state") !== a.pb, te()) : M && Y({
                        reason: "interaction"
                    })
                }), C.on("change:captionsList", function(e, t) {
                    T.trigger(a.l, {
                        tracks: t,
                        track: C.get("captionsIndex") || 0
                    })
                }), C.on("change:mediaModel", function(e, t) {
                    var i = this;
                    e.set("errorEvent", void 0), t.change("mediaState", function(t, i) {
                        var n;
                        e.get("errorEvent") || e.set(a.bb, (n = i) === a.ob || n === a.rb ? a.kb : n)
                    }, this), t.change("duration", function(t, i) {
                        if (0 !== i) {
                            var n = e.get("minDvrWindow"),
                                o = Object(St.b)(i, n);
                            e.setStreamType(o)
                        }
                    }, this);
                    var n = e.get("item") + 1,
                        o = "autoplay" === (e.get("related") || {}).oncomplete,
                        r = e.get("playlist")[n];
                    if ((r || o) && P) {
                        t.on("change:position", function e(n, a) {
                            var s = r && !r.daiSetting,
                                l = t.get("duration");
                            s && a && l > 0 && a >= l - h.b ? (t.off("change:position", e, i), B.backgroundLoad(r)) : o && (r = C.get("nextUp"))
                        }, this)
                    }
                }), (m = new we(C)).on("all", z, T), R.on("viewSetup", function(e) {
                    Object(l.b)(O, e)
                }), this.playerReady = function() {
                    j.once(a.ib, function() {
                        try {
                            ! function() {
                                C.change("visibility", V), L.off(), T.trigger(a.hb, {
                                    setupTime: 0
                                }), C.change("playlist", function(e, t) {
                                    if (t.length) {
                                        var i = {
                                                playlist: t
                                            },
                                            n = C.get("feedData");
                                        if (n) {
                                            var o = Object(r.j)({}, n);
                                            delete o.playlist, i.feedData = o
                                        }
                                        T.trigger(a.eb, i)
                                    }
                                }), C.change("playlistItem", function(e, t) {
                                    if (t) {
                                        var i = t.title,
                                            n = t.image;
                                        if ("mediaSession" in navigator && window.MediaMetadata && (i || n)) try {
                                            navigator.mediaSession.metadata = new window.MediaMetadata({
                                                title: i,
                                                artist: window.location.hostname,
                                                artwork: [{
                                                    src: n || ""
                                                }]
                                            })
                                        } catch (e) {}
                                        e.set("cues", []), T.trigger(a.db, {
                                            index: C.get("item"),
                                            item: t
                                        })
                                    }
                                }), L.flush(), L.destroy(), L = null, C.change("viewable", q), C.change("viewable", D), C.once("change:autostartFailed change:mute", function(e) {
                                    e.off("change:viewable", D)
                                }), C.get("autoPause").viewability && C.change("viewable", W);
                                N(), C.on("change:itemReady", function(e, t) {
                                    t && ce.flush()
                                })
                            }()
                        } catch (e) {
                            T.triggerError(Object(v.A)(v.r, v.a, e))
                        }
                    }), j.init()
                }, this.preload = F, this.load = function(e, t) {
                    var i, n = T._instreamAdapter;
                    switch (n && (n.noResume = !0), T.trigger("destroyPlugin", {}), $(!0), E.cancel(), E = b(N), A.cancel(), Bt(window.event) && w.prime(), Pt(e)) {
                        case "string":
                            C.attributes.item = 0, C.attributes.itemReady = !1, A = b(function(e) {
                                if (e) return T.updatePlaylist(Object(p.a)(e.playlist), e)
                            }), i = function(e) {
                                var t = this;
                                return new Promise(function(i, n) {
                                    var o = new d.a;
                                    o.on(a.eb, function(e) {
                                        i(e)
                                    }), o.on(a.w, n, t), o.load(e)
                                })
                            }(e).then(A.async);
                            break;
                        case "object":
                            C.attributes.item = 0, i = T.updatePlaylist(Object(p.a)(e), t || {});
                            break;
                        case "number":
                            i = T.setItemIndex(e);
                            break;
                        default:
                            return
                    }
                    i.catch(function(e) {
                        T.triggerError(Object(v.z)(e, v.c))
                    }), i.then(E.async).catch(Rt)
                }, this.play = function(e) {
                    return Y(e).catch(Rt)
                }, this.pause = te, this.seek = function(e, t) {
                    var i = C.get("state");
                    if (i !== a.mb) {
                        B.position = e;
                        var n = i === a.nb;
                        C.get("scrubbing") || !n && i !== a.lb || (n && ((t = t || {}).startTime = e), this.play(t))
                    }
                }, this.stop = $, this.playlistItem = ie, this.playlistNext = ne, this.playlistPrev = function(e) {
                    ie(C.get("item") - 1, e)
                }, this.setCurrentCaptions = ae, this.setCurrentQuality = function(e) {
                    B.quality = e
                }, this.setFullscreen = se, this.getCurrentQuality = function() {
                    return B.quality
                }, this.getQualityLevels = function() {
                    return B.qualities
                }, this.setCurrentAudioTrack = function(e) {
                    B.audioTrack = e
                }, this.getCurrentAudioTrack = function() {
                    return B.audioTrack
                }, this.getAudioTracks = function() {
                    return B.audioTracks
                }, this.getCurrentCaptions = function() {
                    return m.getCurrentIndex()
                }, this.getCaptionsList = re, this.getVisualQuality = function() {
                    var e = this._model.get("mediaModel");
                    return e ? e.get(a.U) : null
                }, this.getConfig = function() {
                    return this._model ? this._model.getConfiguration() : void 0
                }, this.getState = Q, this.next = Rt, this.nextItem = function() {
                    ne({
                        reason: "playlist"
                    })
                }, this.setConfig = function(e) {
                    ! function(e, t) {
                        var i = e._model;
                        Object(r.G)(t) && c.forEach(function(n) {
                            var o = t[n];
                            if (!Object(r.y)(o)) switch (n) {
                                case "mute":
                                    e.setMute(o);
                                    break;
                                case "volume":
                                    e.setVolume(o);
                                    break;
                                case "autostart":
                                    ! function(e, t, i) {
                                        e.setAutoStart(i), "idle" === e.get("state") && !0 === i && t.play({
                                            reason: "autostart"
                                        })
                                    }(i, e, o);
                                    break;
                                default:
                                    i.set(n, o)
                            }
                        })
                    }(T, e)
                }, this.setItemIndex = function(e) {
                    B.stopVideo();
                    var t = C.get("playlist").length;
                    return (e = (parseInt(e, 10) || 0) % t) < 0 && (e += t), B.setActiveItem(e).catch(function(e) {
                        e.code >= 151 && e.code <= 162 && (e = Object(v.z)(e, v.e)), O.triggerError(Object(v.A)(v.o, v.d, e))
                    })
                }, this.detachMedia = function() {
                    S && (x = !0), P ? B.backgroundActiveMedia() : B.attached = !1
                }, this.attachMedia = function() {
                    P ? B.restoreBackgroundMedia() : B.attached = !0, "function" == typeof k && k()
                }, this.routeEvents = function(e) {
                    return B.routeEvents(e)
                }, this.forwardEvents = function() {
                    return B.forwardEvents()
                }, this.playVideo = function(e) {
                    return B.playVideo(e)
                }, this.stopVideo = function() {
                    return B.stopVideo()
                }, this.castVideo = function(e, t) {
                    return B.castVideo(e, t)
                }, this.stopCast = function() {
                    return B.stopCast()
                }, this.backgroundActiveMedia = function() {
                    return B.backgroundActiveMedia()
                }, this.restoreBackgroundMedia = function() {
                    return B.restoreBackgroundMedia()
                }, this.preloadNextItem = function() {
                    B.background.currentMedia && B.preloadVideo()
                }, this.isBeforeComplete = function() {
                    return B.beforeComplete
                }, this.setVolume = function(e) {
                    C.setVolume(e), le()
                }, this.setMute = function(e) {
                    C.setMute(e), le()
                }, this.setPlaybackRate = function(e) {
                    C.setPlaybackRate(e)
                }, this.getProvider = function() {
                    return C.get("provider")
                }, this.getWidth = function() {
                    return C.get("containerWidth")
                }, this.getHeight = function() {
                    return C.get("containerHeight")
                }, this.getItemQoe = function() {
                    return C._qoeItem
                }, this.addButton = function(e, t, i, n, o) {
                    var a = C.get("customButtons") || [],
                        r = !1,
                        s = {
                            img: e,
                            tooltip: t,
                            callback: i,
                            id: n,
                            btnClass: o
                        };
                    a = a.reduce(function(e, t) {
                        return t.id === n ? (r = !0, e.push(s)) : e.push(t), e
                    }, []), r || a.unshift(s), C.set("customButtons", a)
                }, this.removeButton = function(e) {
                    var t = C.get("customButtons") || [];
                    t = t.filter(function(t) {
                        return t.id !== e
                    }), C.set("customButtons", t)
                }, this.resize = j.resize, this.getSafeRegion = j.getSafeRegion, this.setCaptions = j.setCaptions, this.checkBeforePlay = function() {
                    return S
                }, this.setControls = function(e) {
                    Object(r.r)(e) || (e = !C.get("controls")), C.set("controls", e), B.controls = e
                }, this.addCues = function(e) {
                    this.setCues(C.get("cues").concat(e))
                }, this.setCues = function(e) {
                    C.set("cues", e)
                }, this.updatePlaylist = function(e, t) {
                    try {
                        var i = Object(p.b)(e, C, t);
                        Object(p.e)(i), C.set("feedData", t), C.set("playlist", i)
                    } catch (e) {
                        return Promise.reject(e)
                    }
                    return this.setItemIndex(C.get("item"))
                }, this.setPlaylistItem = function(e, t) {
                    (t = Object(p.d)(C, new f.a(t), t.feedData || {})) && (C.get("playlist")[e] = t, e === C.get("item") && "idle" === C.get("state") && this.setItemIndex(e))
                }, this.playerDestroy = function() {
                    this.off(), this.stop(), Object(l.b)(this, this.originalContainer), j && j.destroy(), C && C.destroy(), ce && ce.destroy(), m && m.destroy(), B && B.destroy(), this.instreamDestroy()
                }, this.isBeforePlay = this.checkBeforePlay, this.createInstream = function() {
                    return this.instreamDestroy(), this._instreamAdapter = new de(this, C, j, w), this._instreamAdapter
                }, this.skipAd = function() {
                    this._instreamAdapter && this._instreamAdapter.skipAd()
                }, this.instreamDestroy = function() {
                    T._instreamAdapter && (T._instreamAdapter.destroy(), T._instreamAdapter = null)
                };
                var ce = new u.a(this, ["play", "pause", "setCurrentAudioTrack", "setCurrentCaptions", "setCurrentQuality", "setFullscreen"], function() {
                    return !O._model.get("itemReady") || L
                });
                ce.queue.push.apply(ce.queue, o), j.setup()
            },
            get: function(e) {
                if (e in x.a) {
                    var t = this._model.get("mediaModel");
                    return t ? t.get(e) : x.a[e]
                }
                return this._model.get(e)
            },
            getContainer: function() {
                return this.currentContainer || this.originalContainer
            },
            getMute: function() {
                return this._model.getMute()
            },
            triggerError: function(e) {
                var t = this._model;
                e.message = t.get("localization").errors[e.key], delete e.key, t.set("errorEvent", e), t.set("state", a.mb), t.once("change:state", function() {
                    this.set("errorEvent", void 0)
                }, t), this.trigger(a.w, e)
            }
        });
        var Ht = It,
            Vt = "afs_ads";
        var Nt = function(e) {
                var t, i = !1,
                    n = ((t = document.createElement("div")).className = Vt, t.innerHTML = "&nbsp;", t.style.width = "1px", t.style.height = "1px", t.style.position = "absolute", t.style.background = "transparent", t);
                return e.element().appendChild(n), {
                    onReady: function() {
                        if (i) return !0;
                        document.body.contains(e.element()) && (null !== n.offsetParent && n.className === Vt && "" !== n.innerHTML && 0 !== n.clientHeight || (i = !0)), i && this.trigger("adBlock")
                    },
                    getAdBlock: function() {
                        return i
                    }
                }
            },
            qt = i(76),
            Ft = i(32),
            Dt = i(81),
            Ut = Ht.prototype.setup;
        Ht.prototype.setup = function(e, t) {
            var r = this,
                s = Ut.apply(this, arguments),
                l = this._model,
                c = this._view,
                u = Nt(c),
                d = l.get("advertising");
            e.analytics && (e.sdkplatform = e.sdkplatform || e.analytics.sdkplatform), l.once("change:visibility", function() {
                u.onReady.call(r)
            });
            var h = this.playerReady;
            this.playerReady = function() {
                var e = this,
                    i = t.getPlugin("related");
                return i && (i.setup(l), i.on("nextUp", function(e) {
                    var t = null;
                    e === Object(e) && ((t = Object(f.a)(e)).sources = Object(p.c)(t, l)), l.set("nextUp", t)
                }), i.on("warning", function(t) {
                    e.trigger("warning", t)
                })), h.call(this)
            }, this.next = function(e) {
                e = e || {};
                var i = t.getPlugin("related");
                g.call(this, i, "nextClick", e.feedShownId, function() {
                    return i.next(e)
                })
            };
            var w = this.nextItem;

            function g(e, t, i, n) {
                if (e) {
                    var o = l.get("nextUp");
                    o && this.trigger(t, {
                        mode: o.mode,
                        ui: "nextup",
                        feedShownId: i,
                        target: o,
                        itemsShown: [o],
                        feedData: o.feedData
                    }), "function" == typeof n && n()
                }
            }
            this.nextItem = function() {
                var e = t.getPlugin("related");
                g.call(this, e, "nextAutoAdvance"), w.call(this)
            };
            var j = this.updatePlaylist;
            this.updatePlaylist = function(e, i) {
                var o = this,
                    a = [];
                return !Object(qt.a)(e) || t.getPlugin("vr") || l.get("mobileSdk") || a.push(Object(qt.b)(t, l, this)), Object(n.b)(e) && a.push(Object(n.d)(l.get("edition"))), Object(Dt.a)(e, "images", "image"), a.length ? (l.attributes.itemReady = !1, Promise.all(a).then(function() {
                    return j.call(o, e, i)
                })) : j.call(this, e, i)
            }, t.getAdBlock = u.getAdBlock, this.once(a.db, function() {
                this.on(a.db, u.onReady, this);
                var e = d && d.outstream;
                if (l.get("cast") && !e) {
                    var t = l.get("cast") || {};
                    !t.customAppId && Object(n.b)(l.get("playlist")) || function() {
                            var e = this;
                            if (!window.chrome || !y.Browser.chrome) return;
                            i.e(11).then(function(t) {
                                var n = i(150).default,
                                    o = new n(e, l);
                                return e.castToggle = o.castToggle.bind(e._castController), e._castController = o, o.init()
                            }.bind(null, i)).catch(Object(o.c)(301161)).catch(b)
                        }.apply(this),
                        function() {
                            var e = this;
                            if (!window.WebKitPlaybackTargetAvailabilityEvent || l.get("playlist").some(function(e) {
                                    return !Object(Ft.b)(e.sources[0])
                                })) return void m();
                            i.e(10).then(function(t) {
                                var n = i(145).default;
                                e._airplayController = new n(e, l), e.castToggle = e._airplayController.airplayToggle.bind(e._airplayController)
                            }.bind(null, i)).catch(Object(o.c)(301162)).catch(b)
                        }.apply(this)
                } else m()
            }, this);
            var b = function(e) {
                r.trigger(a.ub, e)
            };

            function m() {
                var e = l.getVideo();
                e && e.video && (e.video.webkitWirelessVideoPlaybackDisabled = !0)
            }
            return l.on("change:flashBlocked", function(e, t) {
                var i;
                t ? (!!e.get("flashThrottle") ? i = {
                    message: "Click to run Flash"
                } : (i = new v.s(v.n, 210002), this.trigger(a.w, i)), e.set("errorEvent", i)) : e.set("errorEvent", void 0)
            }, this), d && d.outstream && function(e, t) {
                var i = e._model,
                    n = e._view,
                    o = !1,
                    r = t.height,
                    s = e.getHeight;
                e.getHeight = function() {
                    var e = i.get("aspectratio");
                    return e ? Math.round(i.get("containerWidth") * parseFloat(e) / 100) : r
                }, e.getSafeRegion = function(e) {
                    return n.getSafeRegion(e)
                }, e.resize = function(e, t) {
                    return n.resize(e, t)
                };
                var l = n.resize;
                n.resize = function(e, t) {
                    return r = t, l.call(n, e, t)
                }, i.setAutoStart("viewable"), e.setMute(!0), e.setItemIndex = function() {
                    i.setActiveItem(0)
                }, e.updatePlaylist = function() {
                    return i.set("playlist", [{
                        sources: [{}]
                    }]), i.attributes.itemReady = !0, this.setItemIndex(0), Promise.resolve()
                };
                var c = e.createInstream;
                e.createInstream = function() {
                    var t = c.call(this);
                    return t.noResume = !0, o = !1, t.on("state", function(t) {
                        var i = t.newstate;
                        i !== a.ob && i !== a.qb || (e.attachMedia = d, e.getHeight = s, n.resize = l, o = !0)
                    }), t
                };
                var u = e.attachMedia;
                e.attachMedia = e.playerDestroy;
                var d = function() {
                    return o || i.set("repeat", !1), i.get("backgroundLoading") || this._programController.mediaPool.clean(), i.set("state", a.lb), this._programController.trigger(a.F, {}), u.call(this)
                };
                e._programController.playVideo = function() {
                    return Promise.resolve()
                }
            }(this, e), s
        };
        t.default = Ht
    }, , , , , , , , , , , , , , , , , , , , , , , , , , , , , function(e, t, i) {
        "use strict";
        i.r(t);
        var n = i(0),
            o = i(44),
            a = i(3),
            r = i(105),
            s = i(6),
            l = i(59),
            c = i(124),
            u = i(125),
            d = i(126),
            p = i(70),
            f = i(23),
            h = i(9),
            w = i(55),
            g = i(8),
            j = i(77),
            b = i(78),
            v = i(72),
            m = i(17),
            y = i(1),
            k = 224e3,
            x = 224005,
            O = 221e3,
            T = window.clearTimeout,
            C = "html5",
            S = function() {};

        function _(e, t) {
            Object.keys(e).forEach(function(i) {
                t.removeEventListener(i, e[i])
            })
        }

        function M(e, t, i) {
            this.state = a.nb, this.seeking = !1;
            var o, w = this,
                M = t.minDvrWindow,
                E = {
                    progress: function() {
                        c.a.progress.call(w), he()
                    },
                    timeupdate: function() {
                        q && V !== z.currentTime && $(z.currentTime), c.a.timeupdate.call(w), he(), s.Browser.ie && G()
                    },
                    resize: G,
                    ended: function() {
                        N = -1, we(), c.a.ended.call(w)
                    },
                    loadedmetadata: function() {
                        var e = w.getDuration();
                        Y && e === 1 / 0 && (e = 0);
                        var t = {
                            metadataType: "media",
                            duration: e,
                            height: z.videoHeight,
                            width: z.videoWidth,
                            seekRange: w.getSeekRange()
                        };
                        w.trigger(a.K, t), G()
                    },
                    durationchange: function() {
                        Y || c.a.progress.call(w)
                    },
                    loadeddata: function() {
                        var e;
                        c.a.loadeddata.call(w),
                            function(e) {
                                if (D = null, !e) return;
                                if (e.length) {
                                    for (var t = 0; t < e.length; t++)
                                        if (e[t].enabled) {
                                            U = t;
                                            break
                                        } - 1 === U && (e[U = 0].enabled = !0), D = Object(n.A)(e, function(e) {
                                        var t = {
                                            name: e.label || e.language,
                                            language: e.language
                                        };
                                        return t
                                    })
                                }
                                w.addTracksListener(e, "change", ce), D && w.trigger("audioTracks", {
                                    currentTrack: U,
                                    tracks: D
                                })
                            }(z.audioTracks), e = w.getDuration(), B && -1 !== B && e && e !== 1 / 0 && w.seek(B), G()
                    },
                    canplay: function() {
                        R = !0, Y || fe(), s.Browser.ie && 9 === s.Browser.version.major && w.setTextTracks(w._textTracks), c.a.canplay.call(w)
                    },
                    seeking: function() {
                        var e = null !== H ? ee(H) : w.getCurrentTime(),
                            t = ee(V);
                        V = H, H = null, B = 0, w.seeking = !0, w.trigger(a.Q, {
                            position: t,
                            offset: e
                        })
                    },
                    seeked: function() {
                        c.a.seeked.call(w)
                    },
                    waiting: function() {
                        w.seeking ? w.setState(a.ob) : w.state === a.qb && (w.atEdgeOfLiveStream() && w.setPlaybackRate(1), w.stallTime = w.video.currentTime, w.setState(a.rb))
                    },
                    webkitbeginfullscreen: function(e) {
                        q = !0, ue(e)
                    },
                    webkitendfullscreen: function(e) {
                        q = !1, ue(e)
                    },
                    error: function() {
                        var e = w.video,
                            t = e.error,
                            i = t && t.code || -1,
                            n = k,
                            o = y.o;
                        1 === i ? n += i : 2 === i ? (o = y.l, n = O) : 3 === i || 4 === i ? (n += i - 1, 4 === i && e.src === location.href && (n = x)) : o = y.r, re(), w.trigger(a.G, new y.s(o, n, t))
                    }
                };
            Object.keys(c.a).forEach(function(e) {
                if (!E[e]) {
                    var t = c.a[e];
                    E[e] = function(e) {
                        t.call(w, e)
                    }
                }
            }), Object(n.j)(this, g.a, u.a, d.a, j.a, {
                renderNatively: (o = t.renderCaptionsNatively, !(!s.OS.iOS && !s.Browser.safari) || o && s.Browser.chrome),
                eventsOn_: function() {
                    var e, t;
                    e = E, t = z, Object.keys(e).forEach(function(i) {
                        t.removeEventListener(i, e[i]), t.addEventListener(i, e[i])
                    })
                },
                eventsOff_: function() {
                    _(E, z)
                },
                detachMedia: function() {
                    return d.a.detachMedia.call(w), we(), this.removeTracksListener(z.textTracks, "change", this.textTrackChangeHandler), this.disableTextTrack(), z
                },
                attachMedia: function() {
                    d.a.attachMedia.call(w), R = !1, this.seeking = !1, z.loop = !1, this.enableTextTrack(), this.renderNatively && this.setTextTracks(this.video.textTracks), this.addTracksListener(z.textTracks, "change", this.textTrackChangeHandler)
                },
                isLive: function() {
                    return z.duration === 1 / 0
                }
            });
            var L, z = i,
                P = {
                    level: {}
                },
                I = null !== t.liveTimeout ? t.liveTimeout : 3e4,
                R = !1,
                B = 0,
                H = null,
                V = null,
                N = -1,
                q = !1,
                F = S,
                D = null,
                U = -1,
                W = -1,
                Z = !1,
                Q = null,
                Y = !1,
                K = null,
                X = null,
                J = 0;

            function G() {
                var e = P.level;
                if (e.width !== z.videoWidth || e.height !== z.videoHeight) {
                    if (!z.videoWidth && !pe() || -1 === N) return;
                    e.width = z.videoWidth, e.height = z.videoHeight, fe(), P.reason = P.reason || "auto", P.mode = "hls" === L[N].type ? "auto" : "manual", P.bitrate = 0, e.index = N, e.label = L[N].label, w.trigger(a.U, P), P.reason = ""
                }
            }

            function $(e) {
                V = e
            }

            function ee(e) {
                var t = w.getSeekRange();
                return w.isLive() && Object(p.a)(t.end - t.start, M) ? Math.min(0, e - t.end) : e
            }

            function te(e) {
                var t;
                return Array.isArray(e) && e.length > 0 && (t = e.map(function(e, t) {
                    return {
                        label: e.label || t
                    }
                })), t
            }

            function ie(e) {
                M = e.minDvrWindow, L = e.sources, N = function(e) {
                    var i = Math.max(0, N),
                        n = t.qualityLabel;
                    if (e)
                        for (var o = 0; o < e.length; o++)
                            if (e[o].default && (i = o), n && e[o].label === n) return o;
                    P.reason = "initial choice", P.level.width && P.level.height || (P.level = {});
                    return i
                }(L)
            }

            function ne() {
                return z.paused && z.played && z.played.length && w.isLive() && !Object(p.a)(le() - se(), M) && (w.clearTracks(), z.load()), z.play() || Object(v.a)(z)
            }

            function oe(e) {
                B = 0, we();
                var t = z.src,
                    i = document.createElement("source");
                i.src = L[N].file, i.src !== t ? (ae(L[N]), t && z.load()) : 0 === e && z.currentTime > 0 && (B = -1, w.seek(e)), e > 0 && z.currentTime !== e && w.seek(e);
                var n = te(L);
                n && w.trigger(a.I, {
                    levels: n,
                    currentQuality: N
                }), L.length && "hls" !== L[0].type && w.sendMediaType(L)
            }

            function ae(e) {
                D = null, U = -1, P.reason || (P.reason = "initial choice", P.level = {}), R = !1;
                var t = document.createElement("source");
                t.src = e.file, z.src !== t.src && (z.src = e.file)
            }

            function re() {
                z && (w.disableTextTrack(), z.removeAttribute("preload"), z.removeAttribute("src"), Object(h.g)(z), Object(f.d)(z, {
                    objectFit: ""
                }), N = -1, !s.Browser.msie && "load" in z && z.load())
            }

            function se() {
                var e = 1 / 0;
                return ["buffered", "seekable"].forEach(function(t) {
                    for (var i = z[t], o = i ? i.length : 0; o--;) {
                        var a = Math.min(e, i.start(o));
                        Object(n.s)(a) && (e = a)
                    }
                }), e
            }

            function le() {
                var e = 0;
                return ["buffered", "seekable"].forEach(function(t) {
                    for (var i = z[t], o = i ? i.length : 0; o--;) {
                        var a = Math.max(e, i.end(o));
                        Object(n.s)(a) && (e = a)
                    }
                }), e
            }

            function ce() {
                for (var e = -1, t = 0; t < z.audioTracks.length; t++)
                    if (z.audioTracks[t].enabled) {
                        e = t;
                        break
                    }
                de(e)
            }

            function ue(e) {
                w.trigger("fullscreenchange", {
                    target: e.target,
                    jwstate: q
                })
            }

            function de(e) {
                z && z.audioTracks && D && e > -1 && e < z.audioTracks.length && e !== U && (z.audioTracks[U].enabled = !1, U = e, z.audioTracks[U].enabled = !0, w.trigger("audioTrackChanged", {
                    currentTrack: U,
                    tracks: D
                }))
            }

            function pe() {
                return 0 === z.videoHeight && !((s.OS.iOS || s.Browser.safari) && z.readyState < 2)
            }

            function fe() {
                if ("hls" === L[0].type) {
                    var e = pe() ? "audio" : "video";
                    w.trigger(a.T, {
                        mediaType: e
                    })
                }
            }

            function he() {
                if (0 !== I) {
                    var e = Object(b.a)(z.buffered);
                    w.isLive() && e && Q === e ? -1 === W && (W = setTimeout(function() {
                        Z = !0,
                            function() {
                                if (Z && w.atEdgeOfLiveStream()) return w.trigger(a.G, new y.s(y.p, A)), !0
                            }()
                    }, I)) : (we(), Z = !1), Q = e
                }
            }

            function we() {
                T(W), W = -1
            }
            this.isSDK = !!t.sdkplatform, this.video = z, this.supportsPlaybackRate = !0, w.getCurrentTime = function() {
                return function(e) {
                    var t = w.getSeekRange();
                    if (w.isLive() && Object(p.a)(t.end - t.start, M)) {
                        var i = !X || Math.abs(K - t.end) > 1;
                        return i && function(e) {
                            K = e.end, X = Math.min(0, z.currentTime - K), J = Object(m.a)()
                        }(t), X
                    }
                    return e
                }(z.currentTime)
            }, w.getDuration = function() {
                var e = z.duration;
                if (Y && e === 1 / 0 && 0 === z.currentTime || isNaN(e)) return 0;
                var t = le();
                if (w.isLive() && t) {
                    var i = t - se();
                    Object(p.a)(i, M) && (e = -i)
                }
                return e
            }, w.getSeekRange = function() {
                var e = {
                    start: 0,
                    end: z.duration
                };
                return z.seekable.length && (e.end = le(), e.start = se()), e
            }, this.stop = function() {
                we(), re(), this.clearTracks(), s.Browser.ie && z.pause(), this.setState(a.nb)
            }, this.destroy = function() {
                F = S, _(E, z), this.removeTracksListener(z.audioTracks, "change", ce), this.removeTracksListener(z.textTracks, "change", w.textTrackChangeHandler), this.off()
            }, this.init = function(e) {
                ie(e);
                var t = L[N];
                (Y = Object(l.a)(t)) && (w.supportsPlaybackRate = !1, E.waiting = S), w.eventsOn_(), L.length && "hls" !== L[0].type && this.sendMediaType(L), P.reason = ""
            }, this.preload = function(e) {
                ie(e);
                var t = L[N],
                    i = t.preload || "metadata";
                "none" !== i && (z.setAttribute("preload", i), ae(t))
            }, this.load = function(e) {
                ie(e), oe(e.starttime), this.setupSideloadedTracks(e.tracks)
            }, this.play = function() {
                return F(), ne()
            }, this.pause = function() {
                we(), F = function() {
                    if (z.paused && z.currentTime && w.isLive()) {
                        var e = le(),
                            t = e - se(),
                            i = !Object(p.a)(t, M),
                            o = e - z.currentTime;
                        if (i && e && (o > 15 || o < 0)) {
                            if (H = Math.max(e - 10, e - t), !Object(n.s)(H)) return;
                            $(z.currentTime), z.currentTime = H
                        }
                    }
                }, z.pause()
            }, this.seek = function(e) {
                var t = w.getSeekRange(),
                    i = e;
                if (e < 0 && (i += t.end), R || (R = !!le()), R) {
                    B = 0;
                    try {
                        if (w.seeking = !0, w.isLive() && Object(p.a)(t.end - t.start, M))
                            if (X = Math.min(0, i - K), e < 0) i += Math.min(12, (Object(m.a)() - J) / 1e3);
                        H = i, $(z.currentTime), z.currentTime = i
                    } catch (e) {
                        w.seeking = !1, B = i
                    }
                } else B = i, s.Browser.firefox && z.paused && ne()
            }, this.setVisibility = function(e) {
                (e = !!e) || s.OS.android ? Object(f.d)(w.container, {
                    visibility: "visible",
                    opacity: 1
                }) : Object(f.d)(w.container, {
                    visibility: "",
                    opacity: 0
                })
            }, this.setFullscreen = function(e) {
                if (e = !!e) {
                    try {
                        var t = z.webkitEnterFullscreen || z.webkitEnterFullScreen;
                        t && t.apply(z)
                    } catch (e) {
                        return !1
                    }
                    return w.getFullScreen()
                }
                var i = z.webkitExitFullscreen || z.webkitExitFullScreen;
                return i && i.apply(z), e
            }, w.getFullScreen = function() {
                return q || !!z.webkitDisplayingFullscreen
            }, this.setCurrentQuality = function(e) {
                N !== e && e >= 0 && L && L.length > e && (N = e, P.reason = "api", P.level = {}, this.trigger(a.J, {
                    currentQuality: e,
                    levels: te(L)
                }), t.qualityLabel = L[e].label, oe(z.currentTime || 0), ne())
            }, this.setPlaybackRate = function(e) {
                z.playbackRate = z.defaultPlaybackRate = e
            }, this.getPlaybackRate = function() {
                return z.playbackRate
            }, this.getCurrentQuality = function() {
                return N
            }, this.getQualityLevels = function() {
                return Array.isArray(L) ? L.map(function(e) {
                    return Object(r.a)(e)
                }) : []
            }, this.getName = function() {
                return {
                    name: C
                }
            }, this.setCurrentAudioTrack = de, this.getAudioTracks = function() {
                return D || []
            }, this.getCurrentAudioTrack = function() {
                return U
            }
        }
        Object(n.j)(M.prototype, w.a), M.getName = function() {
            return {
                name: "html5"
            }
        };
        var E = M,
            A = 220001,
            L = i(27),
            z = i(76),
            P = i(127),
            I = function(e, t, i) {
                E.call(this, e, t, i);
                var r = this,
                    s = r.init,
                    l = r.load,
                    c = r.destroy,
                    u = r.renderNatively;

                function d(e) {
                    Object(z.a)([e]) ? r.renderNatively = !1 : r.renderNatively = u
                }

                function p(e) {
                    var t = e.sources[0];
                    if (!r.fairplay || !Object.is(r.fairplay.source, t)) {
                        var i = t.drm;
                        i && i.fairplay ? (r.fairplay = Object(n.j)({}, {
                            certificateUrl: "",
                            processSpcUrl: "",
                            licenseResponseType: "arraybuffer",
                            licenseRequestHeaders: [],
                            licenseRequestMessage: function(e) {
                                return e
                            },
                            licenseRequestFilter: function() {},
                            licenseResponseFilter: function() {},
                            extractContentId: function(e) {
                                return e.split("skd://")[1]
                            },
                            extractKey: function(e) {
                                return new Uint8Array(e)
                            }
                        }, i.fairplay), r.fairplay.source = t, r.fairplay.destroy = function() {
                            B(r.video, "webkitneedkey", f);
                            var e = this.session;
                            e && (B(e, "webkitkeymessage", h), B(e, "webkitkeyerror", m)), r.fairplay = null
                        }, R(r.video, "webkitneedkey", f)) : r.fairplay && r.fairplay.destroy()
                    }
                }

                function f(e) {
                    var t = e.target,
                        i = e.initData;
                    if (t.webkitKeys || t.webkitSetMediaKeys(new window.WebKitMediaKeys("com.apple.fps.1_0")), !t.webkitKeys) throw new Error("Could not create MediaKeys");
                    var n = r.fairplay;
                    n.initData = i, Object(L.a)(n.certificateUrl, function(e) {
                        var o = new Uint8Array(e.response),
                            a = n.extractContentId(H(i));
                        "string" == typeof a && (a = function(e) {
                            for (var t = new ArrayBuffer(2 * e.length), i = new Uint16Array(t), n = 0, o = e.length; n < o; n++) i[n] = e.charCodeAt(n);
                            return i
                        }(a));
                        var r = function(e, t, i) {
                                var n = 0,
                                    o = new ArrayBuffer(e.byteLength + 4 + t.byteLength + 4 + i.byteLength),
                                    a = new DataView(o);
                                new Uint8Array(o, n, e.byteLength).set(e), n += e.byteLength, a.setUint32(n, t.byteLength, !0), n += 4;
                                var r = new Uint16Array(o, n, t.length);
                                return r.set(t), n += r.byteLength, a.setUint32(n, i.byteLength, !0), n += 4, new Uint8Array(o, n, i.byteLength).set(i), new Uint8Array(o, 0, o.byteLength)
                            }(i, a, o),
                            s = t.webkitKeys.createSession("video/mp4", r);
                        if (!s) throw new Error("Could not create key session");
                        R(s, "webkitkeymessage", h), R(s, "webkitkeyerror", m), n.session = s
                    }, v, {
                        responseType: "arraybuffer"
                    })
                }

                function h(e) {
                    var t = r.fairplay,
                        i = e.target,
                        n = e.message,
                        o = new XMLHttpRequest;
                    o.responseType = t.licenseResponseType, o.addEventListener("load", g, !1), o.addEventListener("error", k, !1);
                    var a = "";
                    a = "function" == typeof t.processSpcUrl ? t.processSpcUrl(H(t.initData)) : t.processSpcUrl, o.open("POST", a, !0), o.body = t.licenseRequestMessage(n, i), o.headers = {}, [].concat(t.licenseRequestHeaders || []).forEach(function(e) {
                        o.setRequestHeader(e.name, e.value)
                    });
                    var s = t.licenseRequestFilter.call(e.target, o, t);
                    s && "function" == typeof s.then ? s.then(function() {
                        w(o)
                    }) : w(o)
                }

                function w(e) {
                    Object.keys(e.headers).forEach(function(t) {
                        e.setRequestHeader(t, e.headers[t])
                    }), e.send(e.body)
                }

                function g(e) {
                    var t = r.fairplay,
                        i = e.target,
                        n = {};
                    (i.getAllResponseHeaders() || "").trim().split(/[\r\n]+/).forEach(function(e) {
                        var t = e.split(": "),
                            i = t.shift();
                        n[i] = t.join(": ")
                    });
                    var o = {
                            data: i.response,
                            headers: n
                        },
                        a = t.licenseResponseFilter.call(e.target, o, t);
                    a && "function" == typeof a.then ? a.then(function() {
                        j(o.data)
                    }) : j(o.data)
                }

                function j(e) {
                    var t = r.fairplay.extractKey(e);
                    "function" == typeof t.then ? t.then(b) : b(t)
                }

                function b(e) {
                    var t = r.fairplay.session,
                        i = e;
                    "string" == typeof i && (i = function(e) {
                        for (var t = Object(o.a)(e), i = t.length, n = new Uint8Array(new ArrayBuffer(i)), a = 0; a < i; a++) n[a] = t.charCodeAt(a);
                        return n
                    }(i)), t.update(i)
                }

                function v(e, t, i, n) {
                    n.code += V, n.key = y.q, r.trigger(a.G, n)
                }

                function m(e) {
                    r.trigger(a.G, new y.s(y.q, V + 650, e))
                }

                function k(e) {
                    r.trigger(a.G, new y.s(y.q, N + Object(P.a)(e.currentTarget.status), e))
                }
                this.init = function(e) {
                    p(e), d(e), s.call(this, e)
                }, this.load = function(e) {
                    p(e), d(e), l.call(this, e)
                }, this.destroy = function(e) {
                    this.fairplay && this.fairplay.destroy(), c.call(this, e)
                }
            };

        function R(e, t, i) {
            B(e, t, i), e.addEventListener(t, i, !1)
        }

        function B(e, t, i) {
            e && e.removeEventListener(t, i, !1)
        }

        function H(e) {
            var t = new Uint16Array(e.buffer);
            return String.fromCharCode.apply(null, t)
        }
        Object(n.j)(I.prototype, E.prototype), I.getName = E.getName;
        t.default = I;
        var V = 225e3,
            N = 226e3
    }, , , , , , , , , , , function(e, t, i) {
        "use strict";
        i.d(t, "a", function() {
            return J
        }), i.d(t, "b", function() {
            return G
        });
        var n = i(82),
            o = i.n(n),
            a = i(83),
            r = i.n(a),
            s = i(84),
            l = i.n(s),
            c = i(85),
            u = i.n(c),
            d = i(86),
            p = i.n(d),
            f = i(87),
            h = i.n(f),
            w = i(88),
            g = i.n(w),
            j = i(89),
            b = i.n(j),
            v = i(90),
            m = i.n(v),
            y = i(91),
            k = i.n(y),
            x = i(92),
            O = i.n(x),
            T = i(93),
            C = i.n(T),
            S = i(94),
            _ = i.n(S),
            M = i(95),
            E = i.n(M),
            A = i(96),
            L = i.n(A),
            z = i(97),
            P = i.n(z),
            I = i(98),
            R = i.n(I),
            B = i(99),
            H = i.n(B),
            V = i(100),
            N = i.n(V),
            q = i(101),
            F = i.n(q),
            D = i(102),
            U = i.n(D),
            W = i(103),
            Z = i.n(W),
            Q = i(104),
            Y = i.n(Q),
            K = i(63),
            X = null;

        function J(e) {
            var t = te().querySelector($(e));
            return t ? ee(t) : null
        }

        function G(e) {
            var t = te().querySelectorAll(e.split(",").map($).join(","));
            return Array.prototype.map.call(t, function(e) {
                return ee(e)
            })
        }

        function $(e) {
            return ".jw-svg-icon-".concat(e)
        }

        function ee(e) {
            return e.cloneNode(!0)
        }

        function te() {
            return X || (X = Object(K.a)("<xml>" + o.a + r.a + l.a + u.a + p.a + h.a + g.a + b.a + m.a + k.a + O.a + C.a + _.a + E.a + L.a + P.a + R.a + H.a + N.a + F.a + U.a + Z.a + Y.a + "</xml>")), X
        }
    }, function(e, t, i) {
        "use strict";
        i.d(t, "a", function() {
            return o
        });
        var n = i(2);

        function o(e) {
            var t = [],
                i = (e = Object(n.h)(e)).split("\r\n\r\n");
            1 === i.length && (i = e.split("\n\n"));
            for (var o = 0; o < i.length; o++)
                if ("WEBVTT" !== i[o]) {
                    var r = a(i[o]);
                    r.text && t.push(r)
                }
            return t
        }

        function a(e) {
            var t = {},
                i = e.split("\r\n");
            1 === i.length && (i = e.split("\n"));
            var o = 1;
            if (i[0].indexOf(" --\x3e ") > 0 && (o = 0), i.length > o + 1 && i[o + 1]) {
                var a = i[o],
                    r = a.indexOf(" --\x3e ");
                r > 0 && (t.begin = Object(n.f)(a.substr(0, r)), t.end = Object(n.f)(a.substr(r + 5)), t.text = i.slice(o + 1).join("\r\n"))
            }
            return t
        }
    }, function(e, t, i) {
        "use strict";
        i.d(t, "a", function() {
            return a
        });
        var n, o = i(9);

        function a(e) {
            return n || (n = new DOMParser), Object(o.q)(Object(o.r)(n.parseFromString(e, "image/svg+xml").documentElement))
        }
    }, function(e, t, i) {
        "use strict";
        e.exports = function(e) {
            var t = [];
            return t.toString = function() {
                return this.map(function(t) {
                    var i = function(e, t) {
                        var i = e[1] || "",
                            n = e[3];
                        if (!n) return i;
                        if (t && "function" == typeof btoa) {
                            var o = (r = n, "/*# sourceMappingURL=data:application/json;charset=utf-8;base64," + btoa(unescape(encodeURIComponent(JSON.stringify(r)))) + " */"),
                                a = n.sources.map(function(e) {
                                    return "/*# sourceURL=" + n.sourceRoot + e + " */"
                                });
                            return [i].concat(a).concat([o]).join("\n")
                        }
                        var r;
                        return [i].join("\n")
                    }(t, e);
                    return t[2] ? "@media " + t[2] + "{" + i + "}" : i
                }).join("")
            }, t.i = function(e, i) {
                "string" == typeof e && (e = [
                    [null, e, ""]
                ]);
                for (var n = {}, o = 0; o < this.length; o++) {
                    var a = this[o][0];
                    null != a && (n[a] = !0)
                }
                for (o = 0; o < e.length; o++) {
                    var r = e[o];
                    null != r[0] && n[r[0]] || (i && !r[2] ? r[2] = i : i && (r[2] = "(" + r[2] + ") and (" + i + ")"), t.push(r))
                }
            }, t
        }
    }, function(e, t, i) {
        "use strict";
        i.d(t, "a", function() {
            return n
        }), i.d(t, "b", function() {
            return a
        });
        var n = 12;

        function o() {
            try {
                var e = window.crypto || window.msCrypto;
                if (e && e.getRandomValues) return e.getRandomValues(new Uint32Array(1))[0].toString(36)
            } catch (e) {}
            return Math.random().toString(36).slice(2, 9)
        }

        function a(e) {
            for (var t = ""; t.length < e;) t += o();
            return t.slice(0, e)
        }
    }, function(e, t, i) {
        "use strict";
        var n = window.VTTCue;

        function o(e) {
            if ("string" != typeof e) return !1;
            return !!{
                start: !0,
                middle: !0,
                end: !0,
                left: !0,
                right: !0
            }[e.toLowerCase()] && e.toLowerCase()
        }
        if (!n) {
            (n = function(e, t, i) {
                var n = this;
                n.hasBeenReset = !1;
                var a = "",
                    r = !1,
                    s = e,
                    l = t,
                    c = i,
                    u = null,
                    d = "",
                    p = !0,
                    f = "auto",
                    h = "start",
                    w = "auto",
                    g = 100,
                    j = "middle";
                Object.defineProperty(n, "id", {
                    enumerable: !0,
                    get: function() {
                        return a
                    },
                    set: function(e) {
                        a = "" + e
                    }
                }), Object.defineProperty(n, "pauseOnExit", {
                    enumerable: !0,
                    get: function() {
                        return r
                    },
                    set: function(e) {
                        r = !!e
                    }
                }), Object.defineProperty(n, "startTime", {
                    enumerable: !0,
                    get: function() {
                        return s
                    },
                    set: function(e) {
                        if ("number" != typeof e) throw new TypeError("Start time must be set to a number.");
                        s = e, this.hasBeenReset = !0
                    }
                }), Object.defineProperty(n, "endTime", {
                    enumerable: !0,
                    get: function() {
                        return l
                    },
                    set: function(e) {
                        if ("number" != typeof e) throw new TypeError("End time must be set to a number.");
                        l = e, this.hasBeenReset = !0
                    }
                }), Object.defineProperty(n, "text", {
                    enumerable: !0,
                    get: function() {
                        return c
                    },
                    set: function(e) {
                        c = "" + e, this.hasBeenReset = !0
                    }
                }), Object.defineProperty(n, "region", {
                    enumerable: !0,
                    get: function() {
                        return u
                    },
                    set: function(e) {
                        u = e, this.hasBeenReset = !0
                    }
                }), Object.defineProperty(n, "vertical", {
                    enumerable: !0,
                    get: function() {
                        return d
                    },
                    set: function(e) {
                        var t = function(e) {
                            return "string" == typeof e && !!{
                                "": !0,
                                lr: !0,
                                rl: !0
                            }[e.toLowerCase()] && e.toLowerCase()
                        }(e);
                        if (!1 === t) throw new SyntaxError("An invalid or illegal string was specified.");
                        d = t, this.hasBeenReset = !0
                    }
                }), Object.defineProperty(n, "snapToLines", {
                    enumerable: !0,
                    get: function() {
                        return p
                    },
                    set: function(e) {
                        p = !!e, this.hasBeenReset = !0
                    }
                }), Object.defineProperty(n, "line", {
                    enumerable: !0,
                    get: function() {
                        return f
                    },
                    set: function(e) {
                        if ("number" != typeof e && "auto" !== e) throw new SyntaxError("An invalid number or illegal string was specified.");
                        f = e, this.hasBeenReset = !0
                    }
                }), Object.defineProperty(n, "lineAlign", {
                    enumerable: !0,
                    get: function() {
                        return h
                    },
                    set: function(e) {
                        var t = o(e);
                        if (!t) throw new SyntaxError("An invalid or illegal string was specified.");
                        h = t, this.hasBeenReset = !0
                    }
                }), Object.defineProperty(n, "position", {
                    enumerable: !0,
                    get: function() {
                        return w
                    },
                    set: function(e) {
                        if (e < 0 || e > 100) throw new Error("Position must be between 0 and 100.");
                        w = e, this.hasBeenReset = !0
                    }
                }), Object.defineProperty(n, "size", {
                    enumerable: !0,
                    get: function() {
                        return g
                    },
                    set: function(e) {
                        if (e < 0 || e > 100) throw new Error("Size must be between 0 and 100.");
                        g = e, this.hasBeenReset = !0
                    }
                }), Object.defineProperty(n, "align", {
                    enumerable: !0,
                    get: function() {
                        return j
                    },
                    set: function(e) {
                        var t = o(e);
                        if (!t) throw new SyntaxError("An invalid or illegal string was specified.");
                        j = t, this.hasBeenReset = !0
                    }
                }), n.displayState = void 0
            }).prototype.getCueAsHTML = function() {
                return window.WebVTT.convertCueToDOMTree(window, this.text)
            }
        }
        t.a = n
    }, function(e, t, i) {
        "use strict";
        i.d(t, "b", function() {
            return n
        }), i.d(t, "a", function() {
            return o
        });
        var n = window.requestAnimationFrame || function(e) {
                return setTimeout(e, 17)
            },
            o = window.cancelAnimationFrame || clearTimeout
    }, function(e, t, i) {
        "use strict";

        function n(e, t) {
            var i = e.kind || "cc";
            return e.default || e.defaulttrack ? "default" : e._id || e.file || i + t
        }

        function o(e, t) {
            var i = e.label || e.name || e.language;
            return i || (i = "Unknown CC", (t += 1) > 1 && (i += " [" + t + "]")), {
                label: i,
                unknownCount: t
            }
        }
        i.d(t, "a", function() {
            return n
        }), i.d(t, "b", function() {
            return o
        })
    }, function(e, t, i) {
        "use strict";
        var n = i(66),
            o = i(10),
            a = i(27),
            r = i(4),
            s = i(62),
            l = i(2),
            c = i(1);

        function u(e) {
            throw new c.s(null, e)
        }

        function d(e, t, n) {
            e.xhr = Object(a.a)(e.file, function(a) {
                ! function(e, t, n, a) {
                    var d, p, h = e.responseXML ? e.responseXML.firstChild : null;
                    if (h)
                        for ("xml" === Object(r.b)(h) && (h = h.nextSibling); h.nodeType === h.COMMENT_NODE;) h = h.nextSibling;
                    try {
                        if (h && "tt" === Object(r.b)(h)) d = function(e) {
                            e || u(306007);
                            var t = [],
                                i = e.getElementsByTagName("p"),
                                n = 30,
                                o = e.getElementsByTagName("tt");
                            if (o && o[0]) {
                                var a = parseFloat(o[0].getAttribute("ttp:frameRate"));
                                isNaN(a) || (n = a)
                            }
                            i || u(306005), i.length || (i = e.getElementsByTagName("tt:p")).length || (i = e.getElementsByTagName("tts:p"));
                            for (var r = 0; r < i.length; r++) {
                                for (var s = i[r], c = s.getElementsByTagName("br"), d = 0; d < c.length; d++) {
                                    var p = c[d];
                                    p.parentNode.replaceChild(e.createTextNode("\r\n"), p)
                                }
                                var f = s.innerHTML || s.textContent || s.text || "",
                                    h = Object(l.h)(f).replace(/>\s+</g, "><").replace(/(<\/?)tts?:/g, "$1").replace(/<br.*?\/>/g, "\r\n");
                                if (h) {
                                    var w = s.getAttribute("begin"),
                                        g = s.getAttribute("dur"),
                                        j = s.getAttribute("end"),
                                        b = {
                                            begin: Object(l.f)(w, n),
                                            text: h
                                        };
                                    j ? b.end = Object(l.f)(j, n) : g && (b.end = b.begin + Object(l.f)(g, n)), t.push(b)
                                }
                            }
                            return t.length || u(306005), t
                        }(e.responseXML), p = f(d), delete t.xhr, n(p);
                        else {
                            var w = e.responseText;
                            w.indexOf("WEBVTT") >= 0 ? i.e(17).then(function(e) {
                                return i(132).default
                            }.bind(null, i)).catch(Object(o.c)(301131)).then(function(e) {
                                var i = new e(window);
                                p = [], i.oncue = function(e) {
                                    p.push(e)
                                }, i.onflush = function() {
                                    delete t.xhr, n(p)
                                }, i.parse(w)
                            }).catch(function(e) {
                                delete t.xhr, a(Object(c.A)(null, c.b, e))
                            }) : (d = Object(s.a)(w), p = f(d), delete t.xhr, n(p))
                        }
                    } catch (e) {
                        delete t.xhr, a(Object(c.A)(null, c.b, e))
                    }
                }(a, e, t, n)
            }, function(e, t, i, o) {
                n(Object(c.z)(o, c.b))
            })
        }

        function p(e) {
            e && e.forEach(function(e) {
                var t = e.xhr;
                t && (t.onload = null, t.onreadystatechange = null, t.onerror = null, "abort" in t && t.abort()), delete e.xhr
            })
        }

        function f(e) {
            return e.map(function(e) {
                return new n.a(e.begin, e.end, e.text)
            })
        }
        i.d(t, "c", function() {
            return d
        }), i.d(t, "a", function() {
            return p
        }), i.d(t, "b", function() {
            return f
        })
    }, function(e, t, i) {
        "use strict";

        function n(e, t) {
            return e !== 1 / 0 && Math.abs(e) >= Math.max(a(t), 0)
        }

        function o(e, t) {
            var i = "VOD";
            return e === 1 / 0 ? i = "LIVE" : e < 0 && (i = n(e, a(t)) ? "DVR" : "LIVE"), i
        }

        function a(e) {
            return void 0 === e ? 120 : Math.max(e, 0)
        }
        i.d(t, "a", function() {
            return n
        }), i.d(t, "b", function() {
            return o
        })
    }, function(e, t, i) {
        "use strict";
        i.d(t, "a", function() {
            return o
        }), i.d(t, "b", function() {
            return a
        });
        var n = i(9);

        function o(e) {
            var t = 0;
            return e >= 1280 ? t = 7 : e >= 960 ? t = 6 : e >= 800 ? t = 5 : e >= 640 ? t = 4 : e >= 540 ? t = 3 : e >= 420 ? t = 2 : e >= 320 && (t = 1), t
        }

        function a(e, t) {
            var i = "jw-breakpoint-" + t;
            Object(n.o)(e, /jw-breakpoint-\d+/, i)
        }
    }, function(e, t, i) {
        "use strict";

        function n(e) {
            return new Promise(function(t, i) {
                if (e.paused) return i(o("NotAllowedError", 0, "play() failed."));
                var n = function() {
                        e.removeEventListener("play", a), e.removeEventListener("playing", r), e.removeEventListener("pause", r), e.removeEventListener("abort", r), e.removeEventListener("error", r)
                    },
                    a = function() {
                        e.addEventListener("playing", r), e.addEventListener("abort", r), e.addEventListener("error", r), e.addEventListener("pause", r)
                    },
                    r = function(e) {
                        if (n(), "playing" === e.type) t();
                        else {
                            var a = 'The play() request was interrupted by a "'.concat(e.type, '" event.');
                            "error" === e.type ? i(o("NotSupportedError", 9, a)) : i(o("AbortError", 20, a))
                        }
                    };
                e.addEventListener("play", a)
            })
        }

        function o(e, t, i) {
            var n = new Error(i);
            return n.name = e, n.code = t, n
        }
        i.d(t, "a", function() {
            return n
        })
    }, function(e, t, i) {
        "use strict";
        t.a = "hidden" in document ? function() {
            return !document.hidden
        } : "webkitHidden" in document ? function() {
            return !document.webkitHidden
        } : function() {
            return !0
        }
    }, function(e, t, i) {
        "use strict";
        i.d(t, "c", function() {
            return o
        }), i.d(t, "b", function() {
            return a
        }), i.d(t, "a", function() {
            return r
        });
        var n = {
            TIT2: "title",
            TT2: "title",
            WXXX: "url",
            TPE1: "artist",
            TP1: "artist",
            TALB: "album",
            TAL: "album"
        };

        function o(e, t) {
            for (var i, n, o, a = e.length, r = "", s = t || 0; s < a;)
                if (0 !== (i = e[s++]) && 3 !== i) switch (i >> 4) {
                    case 0:
                    case 1:
                    case 2:
                    case 3:
                    case 4:
                    case 5:
                    case 6:
                    case 7:
                        r += String.fromCharCode(i);
                        break;
                    case 12:
                    case 13:
                        n = e[s++], r += String.fromCharCode((31 & i) << 6 | 63 & n);
                        break;
                    case 14:
                        n = e[s++], o = e[s++], r += String.fromCharCode((15 & i) << 12 | (63 & n) << 6 | (63 & o) << 0)
                }
            return r
        }

        function a(e) {
            var t = function(e) {
                for (var t = "0x", i = 0; i < e.length; i++) e[i] < 16 && (t += "0"), t += e[i].toString(16);
                return parseInt(t)
            }(e);
            return 127 & t | (32512 & t) >> 1 | (8323072 & t) >> 2 | (2130706432 & t) >> 3
        }

        function r() {
            return (arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : []).reduce(function(e, t) {
                if (!("value" in t) && "data" in t && t.data instanceof ArrayBuffer) {
                    var i = new Uint8Array(t.data),
                        r = i.length;
                    t = {
                        value: {
                            key: "",
                            data: ""
                        }
                    };
                    for (var s = 10; s < 14 && s < i.length && 0 !== i[s];) t.value.key += String.fromCharCode(i[s]), s++;
                    var l = 19,
                        c = i[l];
                    3 !== c && 0 !== c || (c = i[++l], r--);
                    var u = 0;
                    if (1 !== c && 2 !== c)
                        for (var d = l + 1; d < r; d++)
                            if (0 === i[d]) {
                                u = d - l;
                                break
                            }
                    if (u > 0) {
                        var p = o(i.subarray(l, l += u), 0);
                        if ("PRIV" === t.value.key) {
                            if ("com.apple.streaming.transportStreamTimestamp" === p) {
                                var f = 1 & a(i.subarray(l, l += 4)),
                                    h = a(i.subarray(l, l += 4)) + (f ? 4294967296 : 0);
                                t.value.data = h
                            } else t.value.data = o(i, l + 1);
                            t.value.info = p
                        } else t.value.info = p, t.value.data = o(i, l + 1)
                    } else {
                        var w = i[l];
                        t.value.data = 1 === w || 2 === w ? function(e, t) {
                            for (var i = e.length - 1, n = "", o = t || 0; o < i;) 254 === e[o] && 255 === e[o + 1] || (n += String.fromCharCode((e[o] << 8) + e[o + 1])), o += 2;
                            return n
                        }(i, l + 1) : o(i, l + 1)
                    }
                }
                if (n.hasOwnProperty(t.value.key) && (e[n[t.value.key]] = t.value.data), t.value.info) {
                    var g = e[t.value.key];
                    g !== Object(g) && (g = {}, e[t.value.key] = g), g[t.value.info] = t.value.data
                } else e[t.value.key] = t.value.data;
                return e
            }, {})
        }
    }, function(e, t) {
        e.exports = '<svg class="jw-svg-icon jw-svg-icon-sharing" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240" focusable="false"><path d="M175,160c-6.9,0.2-13.6,2.6-19,7l-62-39c0.8-2.6,1.2-5.3,1-8c0.2-2.7-0.2-5.4-1-8l62-39c5.4,4.4,12.1,6.8,19,7c16.3,0.3,29.7-12.6,30-28.9c0-0.4,0-0.7,0-1.1c0-16.5-13.5-30-30-30s-30,13.5-30,30c-0.2,2.7,0.2,5.4,1,8L84,97c-5.4-4.4-12.1-6.8-19-7c-16.5,0-30,13.5-30,30s13.5,30,30,30c6.9-0.2,13.6-2.6,19-7l62,39c-0.8,2.6-1.2,5.3-1,8c0,16.5,13.5,30,30,30s30-13.5,30-30S191.6,160,175,160z"></path></svg>'
    }, function(e, t, i) {
        "use strict";
        i.d(t, "a", function() {
            return o
        }), i.d(t, "b", function() {
            return a
        });
        var n = i(10);

        function o(e) {
            return window.WebGLRenderingContext && e.some(function(e) {
                return e.stereomode && e.stereomode.length > 0
            })
        }

        function a(e, t, o) {
            var a = function(e) {
                o.trigger("warning", e)
            };
            return i.e(7).then(function(n) {
                var o = new(0, i(79).default)(e, t);
                e.addPlugin("vr", o), o.on("error", a)
            }.bind(null, i)).catch(Object(n.c)(301132)).catch(a)
        }
    }, function(e, t, i) {
        "use strict";
        var n = i(69),
            o = i(68),
            a = i(74),
            r = i(6),
            s = i(3),
            l = i(0),
            c = {
                _itemTracks: null,
                _textTracks: null,
                _tracksById: null,
                _cuesByTrackId: null,
                _cachedVTTCues: null,
                _metaCuesByTextTime: null,
                _currentTextTrackIndex: -1,
                _unknownCount: 0,
                _activeCues: null,
                _initTextTracks: function() {
                    this._textTracks = [], this._tracksById = {}, this._metaCuesByTextTime = {}, this._cuesByTrackId = {}, this._cachedVTTCues = {}, this._unknownCount = 0
                },
                addTracksListener: function(e, t, i) {
                    if (!e) return;
                    if (u(e, t, i), this.instreamMode) return;
                    e.addEventListener ? e.addEventListener(t, i) : e["on" + t] = i
                },
                clearTracks: function() {
                    Object(n.a)(this._itemTracks);
                    var e = this._tracksById && this._tracksById.nativemetadata;
                    (this.renderNatively || e) && (f(this.renderNatively, this.video.textTracks), e && (e.oncuechange = null));
                    this._itemTracks = null, this._textTracks = null, this._tracksById = null, this._cuesByTrackId = null, this._metaCuesByTextTime = null, this._unknownCount = 0, this._currentTextTrackIndex = -1, this._activeCues = null, this.renderNatively && (this.removeTracksListener(this.video.textTracks, "change", this.textTrackChangeHandler), f(this.renderNatively, this.video.textTracks))
                },
                clearMetaCues: function() {
                    var e = this._tracksById && this._tracksById.nativemetadata;
                    e && (f(this.renderNatively, [e]), e.mode = "hidden", e.inuse = !0, this._cachedVTTCues[e._id] = {})
                },
                clearCueData: function(e) {
                    var t = this._cachedVTTCues;
                    t && t[e] && (t[e] = {}, this._tracksById && (this._tracksById[e].data = []))
                },
                disableTextTrack: function() {
                    if (this._textTracks) {
                        var e = this._textTracks[this._currentTextTrackIndex];
                        if (e) {
                            e.mode = "disabled";
                            var t = e._id;
                            t && 0 === t.indexOf("nativecaptions") && (e.mode = "hidden")
                        }
                    }
                },
                enableTextTrack: function() {
                    if (this._textTracks) {
                        var e = this._textTracks[this._currentTextTrackIndex];
                        e && (e.mode = "showing")
                    }
                },
                getSubtitlesTrack: function() {
                    return this._currentTextTrackIndex
                },
                removeTracksListener: u,
                addTextTracks: d,
                setTextTracks: function(e) {
                    if (this._currentTextTrackIndex = -1, !e) return;
                    this._textTracks ? (this._unknownCount = 0, this._textTracks = this._textTracks.filter(function(e) {
                        var t = e._id;
                        return this.renderNatively && t && 0 === t.indexOf("nativecaptions") ? (delete this._tracksById[t], !1) : (e.name && 0 === e.name.indexOf("Unknown") && this._unknownCount++, !0)
                    }, this), delete this._tracksById.nativemetadata) : this._initTextTracks();
                    if (e.length)
                        for (var t = 0, i = e.length; t < i; t++) {
                            var n = e[t];
                            if (!n._id) {
                                if ("captions" === n.kind || "metadata" === n.kind) {
                                    if (n._id = "native" + n.kind + t, !n.label && "captions" === n.kind) {
                                        var a = Object(o.b)(n, this._unknownCount);
                                        n.name = a.label, this._unknownCount = a.unknownCount
                                    }
                                } else n._id = Object(o.a)(n, this._textTracks.length);
                                if (this._tracksById[n._id]) continue;
                                n.inuse = !0
                            }
                            if (n.inuse && !this._tracksById[n._id])
                                if ("metadata" === n.kind) n.mode = "hidden", n.oncuechange = j.bind(this), this._tracksById[n._id] = n;
                                else if (h(n.kind)) {
                                var s = n.mode,
                                    c = void 0;
                                if (n.mode = "hidden", !n.cues.length && n.embedded) continue;
                                if (n.mode = s, this._cuesByTrackId[n._id] && !this._cuesByTrackId[n._id].loaded) {
                                    for (var u = this._cuesByTrackId[n._id].cues; c = u.shift();) p(this.renderNatively, n, c);
                                    n.mode = s, this._cuesByTrackId[n._id].loaded = !0
                                }
                                g.call(this, n)
                            }
                        }
                    this.renderNatively && (this.textTrackChangeHandler = this.textTrackChangeHandler || function() {
                        var e = this.video.textTracks,
                            t = Object(l.k)(e, function(e) {
                                return (e.inuse || !e._id) && h(e.kind)
                            });
                        if (!this._textTracks || function(e) {
                                if (e.length > this._textTracks.length) return !0;
                                for (var t = 0; t < e.length; t++) {
                                    var i = e[t];
                                    if (!i._id || !this._tracksById[i._id]) return !0
                                }
                                return !1
                            }.call(this, t)) return void this.setTextTracks(e);
                        for (var i = -1, n = 0; n < this._textTracks.length; n++)
                            if ("showing" === this._textTracks[n].mode) {
                                i = n;
                                break
                            }
                        i !== this._currentTextTrackIndex && this.setSubtitlesTrack(i + 1)
                    }.bind(this), this.addTracksListener(this.video.textTracks, "change", this.textTrackChangeHandler), (r.Browser.edge || r.Browser.firefox || r.Browser.safari) && (this.addTrackHandler = this.addTrackHandler || function() {
                        this.setTextTracks(this.video.textTracks)
                    }.bind(this), this.addTracksListener(this.video.textTracks, "addtrack", this.addTrackHandler)));
                    this._textTracks.length && this.trigger("subtitlesTracks", {
                        tracks: this._textTracks
                    })
                },
                setupSideloadedTracks: function(e) {
                    if (!this.renderNatively) return;
                    var t = e === this._itemTracks;
                    t || Object(n.a)(this._itemTracks);
                    if (this._itemTracks = e, !e) return;
                    t || (this.disableTextTrack(), function() {
                        if (!this._textTracks) return;
                        var e = this._textTracks.filter(function(e) {
                            return e.embedded || "subs" === e.groupid
                        });
                        this._initTextTracks(), e.forEach(function(e) {
                            this._tracksById[e._id] = e
                        }), this._textTracks = e
                    }.call(this), this.addTextTracks(e))
                },
                setSubtitlesTrack: function(e) {
                    if (!this.renderNatively) return void(this.setCurrentSubtitleTrack && this.setCurrentSubtitleTrack(e - 1));
                    if (!this._textTracks) return;
                    0 === e && this._textTracks.forEach(function(e) {
                        e.mode = e.embedded ? "hidden" : "disabled"
                    });
                    if (this._currentTextTrackIndex === e - 1) return;
                    this.disableTextTrack(), this._currentTextTrackIndex = e - 1, this._textTracks[this._currentTextTrackIndex] && (this._textTracks[this._currentTextTrackIndex].mode = "showing");
                    this.trigger("subtitlesTrackChanged", {
                        currentTrack: this._currentTextTrackIndex + 1,
                        tracks: this._textTracks
                    })
                },
                textTrackChangeHandler: null,
                addTrackHandler: null,
                addCuesToTrack: function(e) {
                    var t = this._tracksById[e.name];
                    if (!t) return;
                    t.source = e.source;
                    for (var i = e.captions || [], o = [], a = !1, r = 0; r < i.length; r++) {
                        var s = i[r],
                            l = e.name + "_" + s.begin + "_" + s.end;
                        this._metaCuesByTextTime[l] || (this._metaCuesByTextTime[l] = s, o.push(s), a = !0)
                    }
                    a && o.sort(function(e, t) {
                        return e.begin - t.begin
                    });
                    var c = Object(n.b)(o);
                    Array.prototype.push.apply(t.data, c)
                },
                addCaptionsCue: function(e) {
                    if (!e.text || !e.begin || !e.end) return;
                    var t, i = e.trackid.toString(),
                        o = this._tracksById && this._tracksById[i];
                    o || (o = {
                        kind: "captions",
                        _id: i,
                        data: []
                    }, this.addTextTracks([o]), this.trigger("subtitlesTracks", {
                        tracks: this._textTracks
                    }));
                    e.useDTS && (o.source || (o.source = e.source || "mpegts"));
                    t = e.begin + "_" + e.text;
                    var a = this._metaCuesByTextTime[t];
                    if (!a) {
                        a = {
                            begin: e.begin,
                            end: e.end,
                            text: e.text
                        }, this._metaCuesByTextTime[t] = a;
                        var r = Object(n.b)([a])[0];
                        o.data.push(r)
                    }
                },
                addVTTCue: function(e, t) {
                    this._tracksById || this._initTextTracks();
                    var i = e.track ? e.track : "native" + e.type,
                        n = this._tracksById[i],
                        o = "captions" === e.type ? "Unknown CC" : "ID3 Metadata",
                        a = e.cue;
                    if (!n) {
                        var r = {
                            kind: e.type,
                            _id: i,
                            label: o,
                            embedded: !0
                        };
                        n = w.call(this, r), this.renderNatively || "metadata" === n.kind ? this.setTextTracks(this.video.textTracks) : d.call(this, [n])
                    }
                    if (function(e, t, i) {
                            var n = e.kind;
                            this._cachedVTTCues[e._id] || (this._cachedVTTCues[e._id] = {});
                            var o, a = this._cachedVTTCues[e._id];
                            switch (n) {
                                case "captions":
                                case "subtitles":
                                    o = i || Math.floor(20 * t.startTime);
                                    var r = "_" + t.line,
                                        s = Math.floor(20 * t.endTime),
                                        l = a[o + r] || a[o + 1 + r] || a[o - 1 + r];
                                    return !(l && Math.abs(l - s) <= 1) && (a[o + r] = s, !0);
                                case "metadata":
                                    var c = t.data ? new Uint8Array(t.data).join("") : t.text;
                                    return o = i || t.startTime + c, a[o] ? !1 : (a[o] = t.endTime, !0);
                                default:
                                    return !1
                            }
                        }.call(this, n, a, t)) {
                        var s = this.renderNatively || "metadata" === n.kind;
                        return s ? p(s, n, a) : n.data.push(a), a
                    }
                    return null
                },
                addVTTCuesToTrack: function(e, t) {
                    if (!this.renderNatively) return;
                    var i, n = this._tracksById[e._id];
                    if (!n) return this._cuesByTrackId || (this._cuesByTrackId = {}), void(this._cuesByTrackId[e._id] = {
                        cues: t,
                        loaded: !1
                    });
                    if (this._cuesByTrackId[e._id] && this._cuesByTrackId[e._id].loaded) return;
                    this._cuesByTrackId[e._id] = {
                        cues: t,
                        loaded: !0
                    };
                    for (; i = t.shift();) p(this.renderNatively, n, i)
                },
                triggerActiveCues: function(e) {
                    var t = this;
                    if (!e || !e.length) return void(this._activeCues = null);
                    var i = this._activeCues || [],
                        n = Array.prototype.filter.call(e, function(e) {
                            if (i.some(function(t) {
                                    return n = t, (i = e).startTime === n.startTime && i.endTime === n.endTime && i.text === n.text && i.data === n.data && i.value === n.value;
                                    var i, n
                                })) return !1;
                            if (e.data || e.value) return !0;
                            if (e.text) {
                                var n = JSON.parse(e.text),
                                    o = e.startTime,
                                    a = {
                                        metadataTime: o,
                                        metadata: n
                                    };
                                n.programDateTime && (a.programDateTime = n.programDateTime), n.metadataType && (a.metadataType = n.metadataType, delete n.metadataType), t.trigger(s.K, a)
                            }
                            return !1
                        });
                    if (n.length) {
                        var o = Object(a.a)(n),
                            r = n[0].startTime;
                        this.trigger(s.K, {
                            metadataType: "id3",
                            metadataTime: r,
                            metadata: o
                        })
                    }
                    this._activeCues = Array.prototype.slice.call(e)
                },
                renderNatively: !1
            };

        function u(e, t, i) {
            e && (e.removeEventListener ? e.removeEventListener(t, i) : e["on" + t] = null)
        }

        function d(e) {
            var t = this;
            e && (this._textTracks || this._initTextTracks(), e.forEach(function(e) {
                if (!e.kind || h(e.kind)) {
                    var i = w.call(t, e);
                    g.call(t, i), e.file && (e.data = [], Object(n.c)(e, function(e) {
                        t.addVTTCuesToTrack(i, e)
                    }, function(e) {
                        t.trigger(s.ub, e)
                    }))
                }
            }), this._textTracks && this._textTracks.length && this.trigger("subtitlesTracks", {
                tracks: this._textTracks
            }))
        }

        function p(e, t, i) {
            if (r.Browser.ie) {
                var n = i;
                (e || "metadata" === t.kind) && (n = new window.TextTrackCue(i.startTime, i.endTime, i.text)),
                function(e, t) {
                    var i = [],
                        n = e.mode;
                    e.mode = "hidden";
                    for (var o = e.cues, a = o.length - 1; a >= 0 && o[a].startTime > t.startTime; a--) i.unshift(o[a]), e.removeCue(o[a]);
                    e.addCue(t), i.forEach(function(t) {
                        return e.addCue(t)
                    }), e.mode = n
                }(t, n)
            } else t.addCue(i)
        }

        function f(e, t) {
            t && t.length && Object(l.i)(t, function(t) {
                if (!(r.Browser.ie && e && /^(native|subtitle|cc)/.test(t._id))) {
                    t.mode = "disabled", t.mode = "hidden";
                    for (var i = t.cues.length; i--;) t.removeCue(t.cues[i]);
                    t.embedded || (t.mode = "disabled"), t.inuse = !1
                }
            })
        }

        function h(e) {
            return "subtitles" === e || "captions" === e
        }

        function w(e) {
            var t, i = Object(o.b)(e, this._unknownCount),
                n = i.label;
            if (this._unknownCount = i.unknownCount, this.renderNatively || "metadata" === e.kind) {
                var a = this.video.textTracks;
                (t = Object(l.m)(a, {
                    label: n
                })) || (t = this.video.addTextTrack(e.kind, n, e.language || "")), t.default = e.default, t.mode = "disabled", t.inuse = !0
            } else(t = e).data = t.data || [];
            return t._id || (t._id = Object(o.a)(e, this._textTracks.length)), t
        }

        function g(e) {
            this._textTracks.push(e), this._tracksById[e._id] = e
        }

        function j(e) {
            this.triggerActiveCues(e.currentTarget.activeCues)
        }
        t.a = c
    }, function(e, t, i) {
        "use strict";

        function n(e) {
            return e && e.length ? e.end(e.length - 1) : 0
        }
        i.d(t, "a", function() {
            return n
        })
    }, , function(e, t, i) {
        "use strict";
        var n, o = i(73),
            a = i(67),
            r = i(6),
            s = [],
            l = [],
            c = {},
            u = "screen" in window && "orientation" in window.screen,
            d = r.OS.android && r.Browser.chrome,
            p = -1;

        function f(e, t) {
            for (var i = t.length; i--;) {
                var n = t[i];
                if (e.target === n.getContainer()) {
                    n.setIntersection(e);
                    break
                }
            }
        }

        function h() {
            Object(a.a)(p), p = Object(a.b)(function() {
                s.forEach(function(e) {
                    e.updateBounds()
                }), s.forEach(function(e) {
                    e.model.get("visibility") && e.updateStyles()
                }), s.forEach(function(e) {
                    e.checkResized()
                })
            })
        }

        function w() {
            s.forEach(function(e) {
                var t = e.model;
                if (!(t.get("audioMode") || !t.get("controls") || t.get("visibility") < .75)) {
                    var i = t.get("state"),
                        n = window.screen.orientation.type,
                        o = "landscape-primary" === n || "landscape-secondary" === n;
                    !o && "paused" === i && e.api.getFullscreen() ? e.api.setFullscreen(!1) : "playing" === i && e.api.setFullscreen(o)
                }
            })
        }

        function g() {
            s.forEach(function(e) {
                e.model.set("activeTab", Object(o.a)())
            })
        }

        function j(e, t) {
            var i = t.indexOf(e); - 1 !== i && t.splice(i, 1)
        }
        document.addEventListener("visibilitychange", g), document.addEventListener("webkitvisibilitychange", g), window.addEventListener("resize", h), window.addEventListener("orientationchange", h), d && u && window.screen.orientation.addEventListener("change", w), window.addEventListener("beforeunload", function() {
            document.removeEventListener("visibilitychange", g), document.removeEventListener("webkitvisibilitychange", g), window.removeEventListener("resize", h), window.removeEventListener("orientationchange", h), d && u && window.screen.orientation.removeEventListener("change", w)
        }), t.a = {
            add: function(e) {
                s.push(e)
            },
            remove: function(e) {
                j(e, s)
            },
            addWidget: function(e) {
                l.push(e)
            },
            removeWidget: function(e) {
                j(e, l)
            },
            size: function() {
                return s.length
            },
            observe: function(e) {
                var t;
                t = window.IntersectionObserver, n || (n = new t(function(e) {
                    if (e && e.length)
                        for (var t = e.length; t--;) {
                            var i = e[t];
                            f(i, s), f(i, l)
                        }
                }, {
                    threshold: [0, .1, .2, .3, .4, .5, .6, .7, .8, .9, 1]
                })), c[e.id] || (c[e.id] = !0, n.observe(e))
            },
            unobserve: function(e) {
                n && c[e.id] && (delete c[e.id], n.unobserve(e))
            }
        }
    }, function(e, t, i) {
        "use strict";
        i.d(t, "a", function() {
            return a
        });
        var n, o = i(65);

        function a(e, t, i) {
            var a = function() {
                try {
                    n = window.localStorage.jwplayerLocalId
                } catch (e) {}
                return n = n || Object(o.b)(12)
            }();
            e.forEach(function(e) {
                var n = e.variations;
                if (n && n[t]) {
                    n.selected = n.selected || {};
                    var o = function(e, t) {
                            for (var i = function(e) {
                                    for (var t = 1794770992, i = 0, n = e.length; i < n; i++) t ^= e.charCodeAt(i), t += (t << 1) + (t << 4) + (t << 7) + (t << 8) + (t << 24);
                                    return t >>> 0
                                }(e) % 2520, n = t.reduce(function(e, t) {
                                    return e + t.weight
                                }, 0), o = 0, a = 0; a < t.length; a++) {
                                var r = t[a];
                                if ((o += 2520 * r.weight / n) > i) return r
                            }
                        }(a, n[t]),
                        r = o[i];
                    r && (e[i] = r, n.selected[t] = o)
                }
            })
        }
    }, function(e, t) {
        e.exports = '<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-buffer" viewBox="0 0 240 240" focusable="false"><path d="M120,186.667a66.667,66.667,0,0,1,0-133.333V40a80,80,0,1,0,80,80H186.667A66.846,66.846,0,0,1,120,186.667Z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg class="jw-svg-icon jw-svg-icon-replay" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240" focusable="false"><path d="M120,41.9v-20c0-5-4-8-8-4l-44,28a5.865,5.865,0,0,0-3.3,7.6A5.943,5.943,0,0,0,68,56.8l43,29c5,4,9,1,9-4v-20a60,60,0,1,1-60,60H40a80,80,0,1,0,80-79.9Z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-error" viewBox="0 0 36 36" style="width:100%;height:100%;" focusable="false"><path d="M34.6 20.2L10 33.2 27.6 16l7 3.7a.4.4 0 0 1 .2.5.4.4 0 0 1-.2.2zM33.3 0L21 12.2 9 6c-.2-.3-.6 0-.6.5V25L0 33.6 2.5 36 36 2.7z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-play" viewBox="0 0 240 240" focusable="false"><path d="M62.8,199.5c-1,0.8-2.4,0.6-3.3-0.4c-0.4-0.5-0.6-1.1-0.5-1.8V42.6c-0.2-1.3,0.7-2.4,1.9-2.6c0.7-0.1,1.3,0.1,1.9,0.4l154.7,77.7c2.1,1.1,2.1,2.8,0,3.8L62.8,199.5z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-pause" viewBox="0 0 240 240" focusable="false"><path d="M100,194.9c0.2,2.6-1.8,4.8-4.4,5c-0.2,0-0.4,0-0.6,0H65c-2.6,0.2-4.8-1.8-5-4.4c0-0.2,0-0.4,0-0.6V45c-0.2-2.6,1.8-4.8,4.4-5c0.2,0,0.4,0,0.6,0h30c2.6-0.2,4.8,1.8,5,4.4c0,0.2,0,0.4,0,0.6V194.9z M180,45.1c0.2-2.6-1.8-4.8-4.4-5c-0.2,0-0.4,0-0.6,0h-30c-2.6-0.2-4.8,1.8-5,4.4c0,0.2,0,0.4,0,0.6V195c-0.2,2.6,1.8,4.8,4.4,5c0.2,0,0.4,0,0.6,0h30c2.6,0.2,4.8-1.8,5-4.4c0-0.2,0-0.4,0-0.6V45.1z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg class="jw-svg-icon jw-svg-icon-rewind" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240" focusable="false"><path d="M113.2,131.078a21.589,21.589,0,0,0-17.7-10.6,21.589,21.589,0,0,0-17.7,10.6,44.769,44.769,0,0,0,0,46.3,21.589,21.589,0,0,0,17.7,10.6,21.589,21.589,0,0,0,17.7-10.6,44.769,44.769,0,0,0,0-46.3Zm-17.7,47.2c-7.8,0-14.4-11-14.4-24.1s6.6-24.1,14.4-24.1,14.4,11,14.4,24.1S103.4,178.278,95.5,178.278Zm-43.4,9.7v-51l-4.8,4.8-6.8-6.8,13-13a4.8,4.8,0,0,1,8.2,3.4v62.7l-9.6-.1Zm162-130.2v125.3a4.867,4.867,0,0,1-4.8,4.8H146.6v-19.3h48.2v-96.4H79.1v19.3c0,5.3-3.6,7.2-8,4.3l-41.8-27.9a6.013,6.013,0,0,1-2.7-8,5.887,5.887,0,0,1,2.7-2.7l41.8-27.9c4.4-2.9,8-1,8,4.3v19.3H209.2A4.974,4.974,0,0,1,214.1,57.778Z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-next" viewBox="0 0 240 240" focusable="false"><path d="M165,60v53.3L59.2,42.8C56.9,41.3,55,42.3,55,45v150c0,2.7,1.9,3.8,4.2,2.2L165,126.6v53.3h20v-120L165,60L165,60z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg class="jw-svg-icon jw-svg-icon-stop" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240" focusable="false"><path d="M190,185c0.2,2.6-1.8,4.8-4.4,5c-0.2,0-0.4,0-0.6,0H55c-2.6,0.2-4.8-1.8-5-4.4c0-0.2,0-0.4,0-0.6V55c-0.2-2.6,1.8-4.8,4.4-5c0.2,0,0.4,0,0.6,0h130c2.6-0.2,4.8,1.8,5,4.4c0,0.2,0,0.4,0,0.6V185z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg class="jw-svg-icon jw-svg-icon-volume-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240" focusable="false"><path d="M116.4,42.8v154.5c0,2.8-1.7,3.6-3.8,1.7l-54.1-48.1H28.9c-2.8,0-5.2-2.3-5.2-5.2V94.2c0-2.8,2.3-5.2,5.2-5.2h29.6l54.1-48.1C114.6,39.1,116.4,39.9,116.4,42.8z M212.3,96.4l-14.6-14.6l-23.6,23.6l-23.6-23.6l-14.6,14.6l23.6,23.6l-23.6,23.6l14.6,14.6l23.6-23.6l23.6,23.6l14.6-14.6L188.7,120L212.3,96.4z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg class="jw-svg-icon jw-svg-icon-volume-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240" focusable="false"><path d="M116.4,42.8v154.5c0,2.8-1.7,3.6-3.8,1.7l-54.1-48.1H28.9c-2.8,0-5.2-2.3-5.2-5.2V94.2c0-2.8,2.3-5.2,5.2-5.2h29.6l54.1-48.1C114.7,39.1,116.4,39.9,116.4,42.8z M178.2,120c0-22.7-18.5-41.2-41.2-41.2v20.6c11.4,0,20.6,9.2,20.6,20.6c0,11.4-9.2,20.6-20.6,20.6v20.6C159.8,161.2,178.2,142.7,178.2,120z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg class="jw-svg-icon jw-svg-icon-volume-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240" focusable="false"><path d="M116.5,42.8v154.4c0,2.8-1.7,3.6-3.8,1.7l-54.1-48H29c-2.8,0-5.2-2.3-5.2-5.2V94.3c0-2.8,2.3-5.2,5.2-5.2h29.6l54.1-48C114.8,39.2,116.5,39.9,116.5,42.8z"></path><path d="M136.2,160v-20c11.1,0,20-8.9,20-20s-8.9-20-20-20V80c22.1,0,40,17.9,40,40S158.3,160,136.2,160z"></path><path d="M216.2,120c0-44.2-35.8-80-80-80v20c33.1,0,60,26.9,60,60s-26.9,60-60,60v20C180.4,199.9,216.1,164.1,216.2,120z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-cc-on" viewBox="0 0 240 240" focusable="false"><path d="M215,40H25c-2.7,0-5,2.2-5,5v150c0,2.7,2.2,5,5,5h190c2.7,0,5-2.2,5-5V45C220,42.2,217.8,40,215,40z M108.1,137.7c0.7-0.7,1.5-1.5,2.4-2.3l6.6,7.8c-2.2,2.4-5,4.4-8,5.8c-8,3.5-17.3,2.4-24.3-2.9c-3.9-3.6-5.9-8.7-5.5-14v-25.6c0-2.7,0.5-5.3,1.5-7.8c0.9-2.2,2.4-4.3,4.2-5.9c5.7-4.5,13.2-6.2,20.3-4.6c3.3,0.5,6.3,2,8.7,4.3c1.3,1.3,2.5,2.6,3.5,4.2l-7.1,6.9c-2.4-3.7-6.5-5.9-10.9-5.9c-2.4-0.2-4.8,0.7-6.6,2.3c-1.7,1.7-2.5,4.1-2.4,6.5v25.6C90.4,141.7,102,143.5,108.1,137.7z M152.9,137.7c0.7-0.7,1.5-1.5,2.4-2.3l6.6,7.8c-2.2,2.4-5,4.4-8,5.8c-8,3.5-17.3,2.4-24.3-2.9c-3.9-3.6-5.9-8.7-5.5-14v-25.6c0-2.7,0.5-5.3,1.5-7.8c0.9-2.2,2.4-4.3,4.2-5.9c5.7-4.5,13.2-6.2,20.3-4.6c3.3,0.5,6.3,2,8.7,4.3c1.3,1.3,2.5,2.6,3.5,4.2l-7.1,6.9c-2.4-3.7-6.5-5.9-10.9-5.9c-2.4-0.2-4.8,0.7-6.6,2.3c-1.7,1.7-2.5,4.1-2.4,6.5v25.6C135.2,141.7,146.8,143.5,152.9,137.7z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-cc-off" viewBox="0 0 240 240" focusable="false"><path d="M99.4,97.8c-2.4-0.2-4.8,0.7-6.6,2.3c-1.7,1.7-2.5,4.1-2.4,6.5v25.6c0,9.6,11.6,11.4,17.7,5.5c0.7-0.7,1.5-1.5,2.4-2.3l6.6,7.8c-2.2,2.4-5,4.4-8,5.8c-8,3.5-17.3,2.4-24.3-2.9c-3.9-3.6-5.9-8.7-5.5-14v-25.6c0-2.7,0.5-5.3,1.5-7.8c0.9-2.2,2.4-4.3,4.2-5.9c5.7-4.5,13.2-6.2,20.3-4.6c3.3,0.5,6.3,2,8.7,4.3c1.3,1.3,2.5,2.6,3.5,4.2l-7.1,6.9C107.9,100,103.8,97.8,99.4,97.8z M144.1,97.8c-2.4-0.2-4.8,0.7-6.6,2.3c-1.7,1.7-2.5,4.1-2.4,6.5v25.6c0,9.6,11.6,11.4,17.7,5.5c0.7-0.7,1.5-1.5,2.4-2.3l6.6,7.8c-2.2,2.4-5,4.4-8,5.8c-8,3.5-17.3,2.4-24.3-2.9c-3.9-3.6-5.9-8.7-5.5-14v-25.6c0-2.7,0.5-5.3,1.5-7.8c0.9-2.2,2.4-4.3,4.2-5.9c5.7-4.5,13.2-6.2,20.3-4.6c3.3,0.5,6.3,2,8.7,4.3c1.3,1.3,2.5,2.6,3.5,4.2l-7.1,6.9C152.6,100,148.5,97.8,144.1,97.8L144.1,97.8z M200,60v120H40V60H200 M215,40H25c-2.7,0-5,2.2-5,5v150c0,2.7,2.2,5,5,5h190c2.7,0,5-2.2,5-5V45C220,42.2,217.8,40,215,40z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-airplay-on" viewBox="0 0 240 240" focusable="false"><path d="M229.9,40v130c0.2,2.6-1.8,4.8-4.4,5c-0.2,0-0.4,0-0.6,0h-44l-17-20h46V55H30v100h47l-17,20h-45c-2.6,0.2-4.8-1.8-5-4.4c0-0.2,0-0.4,0-0.6V40c-0.2-2.6,1.8-4.8,4.4-5c0.2,0,0.4,0,0.6,0h209.8c2.6-0.2,4.8,1.8,5,4.4C229.9,39.7,229.9,39.9,229.9,40z M104.9,122l15-18l15,18l11,13h44V75H50v60h44L104.9,122z M179.9,205l-60-70l-60,70H179.9z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-airplay-off" viewBox="0 0 240 240" focusable="false"><path d="M210,55v100h-50l20,20h45c2.6,0.2,4.8-1.8,5-4.4c0-0.2,0-0.4,0-0.6V40c0.2-2.6-1.8-4.8-4.4-5c-0.2,0-0.4,0-0.6,0H15c-2.6-0.2-4.8,1.8-5,4.4c0,0.2,0,0.4,0,0.6v130c-0.2,2.6,1.8,4.8,4.4,5c0.2,0,0.4,0,0.6,0h45l20-20H30V55H210 M60,205l60-70l60,70H60L60,205z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-playback-rate" viewBox="0 0 240 240" focusable="false"><path d="M158.83,48.83A71.17,71.17,0,1,0,230,120,71.163,71.163,0,0,0,158.83,48.83Zm45.293,77.632H152.34V74.708h12.952v38.83h38.83ZM35.878,74.708h38.83V87.66H35.878ZM10,113.538H61.755V126.49H10Zm25.878,38.83h38.83V165.32H35.878Z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg class="jw-svg-icon jw-svg-icon-settings" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240" focusable="false"><path d="M204,145l-25-14c0.8-3.6,1.2-7.3,1-11c0.2-3.7-0.2-7.4-1-11l25-14c2.2-1.6,3.1-4.5,2-7l-16-26c-1.2-2.1-3.8-2.9-6-2l-25,14c-6-4.2-12.3-7.9-19-11V35c0.2-2.6-1.8-4.8-4.4-5c-0.2,0-0.4,0-0.6,0h-30c-2.6-0.2-4.8,1.8-5,4.4c0,0.2,0,0.4,0,0.6v28c-6.7,3.1-13,6.7-19,11L56,60c-2.2-0.9-4.8-0.1-6,2L35,88c-1.6,2.2-1.3,5.3,0.9,6.9c0,0,0.1,0,0.1,0.1l25,14c-0.8,3.6-1.2,7.3-1,11c-0.2,3.7,0.2,7.4,1,11l-25,14c-2.2,1.6-3.1,4.5-2,7l16,26c1.2,2.1,3.8,2.9,6,2l25-14c5.7,4.6,12.2,8.3,19,11v28c-0.2,2.6,1.8,4.8,4.4,5c0.2,0,0.4,0,0.6,0h30c2.6,0.2,4.8-1.8,5-4.4c0-0.2,0-0.4,0-0.6v-28c7-2.3,13.5-6,19-11l25,14c2.5,1.3,5.6,0.4,7-2l15-26C206.7,149.4,206,146.7,204,145z M120,149.9c-16.5,0-30-13.4-30-30s13.4-30,30-30s30,13.4,30,30c0.3,16.3-12.6,29.7-28.9,30C120.7,149.9,120.4,149.9,120,149.9z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg class="jw-svg-icon jw-svg-icon-audio-tracks" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240" focusable="false"><path d="M35,34h160v20H35V34z M35,94h160V74H35V94z M35,134h60v-20H35V134z M160,114c-23.4-1.3-43.6,16.5-45,40v50h20c5.2,0.3,9.7-3.6,10-8.9c0-0.4,0-0.7,0-1.1v-20c0.3-5.2-3.6-9.7-8.9-10c-0.4,0-0.7,0-1.1,0h-10v-10c1.5-17.9,17.1-31.3,35-30c17.9-1.3,33.6,12.1,35,30v10H185c-5.2-0.3-9.7,3.6-10,8.9c0,0.4,0,0.7,0,1.1v20c-0.3,5.2,3.6,9.7,8.9,10c0.4,0,0.7,0,1.1,0h20v-50C203.5,130.6,183.4,112.7,160,114z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg class="jw-svg-icon jw-svg-icon-quality-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240" focusable="false"><path d="M55,200H35c-3,0-5-2-5-4c0,0,0,0,0-1v-30c0-3,2-5,4-5c0,0,0,0,1,0h20c3,0,5,2,5,4c0,0,0,0,0,1v30C60,198,58,200,55,200L55,200z M110,195v-70c0-3-2-5-4-5c0,0,0,0-1,0H85c-3,0-5,2-5,4c0,0,0,0,0,1v70c0,3,2,5,4,5c0,0,0,0,1,0h20C108,200,110,198,110,195L110,195z M160,195V85c0-3-2-5-4-5c0,0,0,0-1,0h-20c-3,0-5,2-5,4c0,0,0,0,0,1v110c0,3,2,5,4,5c0,0,0,0,1,0h20C158,200,160,198,160,195L160,195z M210,195V45c0-3-2-5-4-5c0,0,0,0-1,0h-20c-3,0-5,2-5,4c0,0,0,0,0,1v150c0,3,2,5,4,5c0,0,0,0,1,0h20C208,200,210,198,210,195L210,195z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-fullscreen-off" viewBox="0 0 240 240" focusable="false"><path d="M109.2,134.9l-8.4,50.1c-0.4,2.7-2.4,3.3-4.4,1.4L82,172l-27.9,27.9l-14.2-14.2l27.9-27.9l-14.4-14.4c-1.9-1.9-1.3-3.9,1.4-4.4l50.1-8.4c1.8-0.5,3.6,0.6,4.1,2.4C109.4,133.7,109.4,134.3,109.2,134.9L109.2,134.9z M172.1,82.1L200,54.2L185.8,40l-27.9,27.9l-14.4-14.4c-1.9-1.9-3.9-1.3-4.4,1.4l-8.4,50.1c-0.5,1.8,0.6,3.6,2.4,4.1c0.5,0.2,1.2,0.2,1.7,0l50.1-8.4c2.7-0.4,3.3-2.4,1.4-4.4L172.1,82.1z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-fullscreen-on" viewBox="0 0 240 240" focusable="false"><path d="M96.3,186.1c1.9,1.9,1.3,4-1.4,4.4l-50.6,8.4c-1.8,0.5-3.7-0.6-4.2-2.4c-0.2-0.6-0.2-1.2,0-1.7l8.4-50.6c0.4-2.7,2.4-3.4,4.4-1.4l14.5,14.5l28.2-28.2l14.3,14.3l-28.2,28.2L96.3,186.1z M195.8,39.1l-50.6,8.4c-2.7,0.4-3.4,2.4-1.4,4.4l14.5,14.5l-28.2,28.2l14.3,14.3l28.2-28.2l14.5,14.5c1.9,1.9,4,1.3,4.4-1.4l8.4-50.6c0.5-1.8-0.6-3.6-2.4-4.2C197,39,196.4,39,195.8,39.1L195.8,39.1z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-close" viewBox="0 0 240 240" focusable="false"><path d="M134.8,120l48.6-48.6c2-1.9,2.1-5.2,0.2-7.2c0,0-0.1-0.1-0.2-0.2l-7.4-7.4c-1.9-2-5.2-2.1-7.2-0.2c0,0-0.1,0.1-0.2,0.2L120,105.2L71.4,56.6c-1.9-2-5.2-2.1-7.2-0.2c0,0-0.1,0.1-0.2,0.2L56.6,64c-2,1.9-2.1,5.2-0.2,7.2c0,0,0.1,0.1,0.2,0.2l48.6,48.7l-48.6,48.6c-2,1.9-2.1,5.2-0.2,7.2c0,0,0.1,0.1,0.2,0.2l7.4,7.4c1.9,2,5.2,2.1,7.2,0.2c0,0,0.1-0.1,0.2-0.2l48.7-48.6l48.6,48.6c1.9,2,5.2,2.1,7.2,0.2c0,0,0.1-0.1,0.2-0.2l7.4-7.4c2-1.9,2.1-5.2,0.2-7.2c0,0-0.1-0.1-0.2-0.2L134.8,120z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-jwplayer-logo" viewBox="0 0 992 1024" focusable="false"><path d="M144 518.4c0 6.4-6.4 6.4-6.4 0l-3.2-12.8c0 0-6.4-19.2-12.8-38.4 0-6.4-6.4-12.8-9.6-22.4-6.4-6.4-16-9.6-28.8-6.4-9.6 3.2-16 12.8-16 22.4s0 16 0 25.6c3.2 25.6 22.4 121.6 32 140.8 9.6 22.4 35.2 32 54.4 22.4 22.4-9.6 28.8-35.2 38.4-54.4 9.6-25.6 60.8-166.4 60.8-166.4 6.4-12.8 9.6-12.8 9.6 0 0 0 0 140.8-3.2 204.8 0 25.6 0 67.2 9.6 89.6 6.4 16 12.8 28.8 25.6 38.4s28.8 12.8 44.8 12.8c6.4 0 16-3.2 22.4-6.4 9.6-6.4 16-12.8 25.6-22.4 16-19.2 28.8-44.8 38.4-64 25.6-51.2 89.6-201.6 89.6-201.6 6.4-12.8 9.6-12.8 9.6 0 0 0-9.6 256-9.6 355.2 0 25.6 6.4 48 12.8 70.4 9.6 22.4 22.4 38.4 44.8 48s48 9.6 70.4-3.2c16-9.6 28.8-25.6 38.4-38.4 12.8-22.4 25.6-48 32-70.4 19.2-51.2 35.2-102.4 51.2-153.6s153.6-540.8 163.2-582.4c0-6.4 0-9.6 0-12.8 0-9.6-6.4-19.2-16-22.4-16-6.4-32 0-38.4 12.8-6.4 16-195.2 470.4-195.2 470.4-6.4 12.8-9.6 12.8-9.6 0 0 0 0-156.8 0-288 0-70.4-35.2-108.8-83.2-118.4-22.4-3.2-44.8 0-67.2 12.8s-35.2 32-48 54.4c-16 28.8-105.6 297.6-105.6 297.6-6.4 12.8-9.6 12.8-9.6 0 0 0-3.2-115.2-6.4-144-3.2-41.6-12.8-108.8-67.2-115.2-51.2-3.2-73.6 57.6-86.4 99.2-9.6 25.6-51.2 163.2-51.2 163.2v3.2z"></path></svg>'
    }, function(e, t, i) {
        "use strict";

        function n(e) {
            return {
                bitrate: e.bitrate,
                label: e.label,
                width: e.width,
                height: e.height
            }
        }
        i.d(t, "a", function() {
            return n
        })
    }, function(e, t, i) {
        var n = i(107);
        "string" == typeof n && (n = [
            ["all-players", n, ""]
        ]), i(41).style(n, "all-players"), n.locals && (e.exports = n.locals)
    }, function(e, t, i) {
        (e.exports = i(64)(!1)).push([e.i, '.jw-reset{text-align:left;direction:ltr}.jw-reset-text,.jw-reset{color:inherit;background-color:transparent;padding:0;margin:0;float:none;font-family:Arial,Helvetica,sans-serif;font-size:1em;line-height:1em;list-style:none;text-transform:none;vertical-align:baseline;border:0;font-variant:inherit;font-stretch:inherit;-webkit-tap-highlight-color:rgba(255,255,255,0)}body .jw-error,body .jwplayer.jw-state-error{height:100%;width:100%}.jw-title{position:absolute;top:0}.jw-background-color{background:rgba(0,0,0,0.4)}.jw-text{color:rgba(255,255,255,0.8)}.jw-knob{color:rgba(255,255,255,0.8);background-color:#fff}.jw-button-color{color:rgba(255,255,255,0.8)}:not(.jw-flag-touch) .jw-button-color:not(.jw-logo-button):focus,:not(.jw-flag-touch) .jw-button-color:not(.jw-logo-button):hover{color:#fff}.jw-toggle{color:#fff}.jw-toggle.jw-off{color:rgba(255,255,255,0.8)}.jw-toggle.jw-off:focus{color:#fff}.jw-toggle:focus{outline:none}:not(.jw-flag-touch) .jw-toggle.jw-off:hover{color:#fff}.jw-rail{background:rgba(255,255,255,0.3)}.jw-buffer{background:rgba(255,255,255,0.3)}.jw-progress{background:#f2f2f2}.jw-time-tip,.jw-volume-tip{border:0}.jw-slider-volume.jw-volume-tip.jw-background-color.jw-slider-vertical{background:none}.jw-skip{padding:.5em;outline:none}.jw-skip .jw-skiptext,.jw-skip .jw-skip-icon{color:rgba(255,255,255,0.8)}.jw-skip.jw-skippable:hover .jw-skip-icon,.jw-skip.jw-skippable:focus .jw-skip-icon{color:#fff}.jw-icon-cast google-cast-launcher{--connected-color:#fff;--disconnected-color:rgba(255,255,255,0.8)}.jw-icon-cast google-cast-launcher:focus{outline:none}.jw-icon-cast google-cast-launcher.jw-off{--connected-color:rgba(255,255,255,0.8)}.jw-icon-cast:focus google-cast-launcher{--connected-color:#fff;--disconnected-color:#fff}.jw-icon-cast:hover google-cast-launcher{--connected-color:#fff;--disconnected-color:#fff}.jw-nextup-container{bottom:2.5em;padding:5px .5em}.jw-nextup{border-radius:0}.jw-color-active{color:#fff;stroke:#fff;border-color:#fff}:not(.jw-flag-touch) .jw-color-active-hover:hover,:not(.jw-flag-touch) .jw-color-active-hover:focus{color:#fff;stroke:#fff;border-color:#fff}.jw-color-inactive{color:rgba(255,255,255,0.8);stroke:rgba(255,255,255,0.8);border-color:rgba(255,255,255,0.8)}:not(.jw-flag-touch) .jw-color-inactive-hover:hover{color:rgba(255,255,255,0.8);stroke:rgba(255,255,255,0.8);border-color:rgba(255,255,255,0.8)}.jw-option{color:rgba(255,255,255,0.8)}.jw-option.jw-active-option{color:#fff;background-color:rgba(255,255,255,0.1)}:not(.jw-flag-touch) .jw-option:hover{color:#fff}.jwplayer{width:100%;font-size:16px;position:relative;display:block;min-height:0;overflow:hidden;box-sizing:border-box;font-family:Arial,Helvetica,sans-serif;-webkit-touch-callout:none;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;outline:none}.jwplayer *{box-sizing:inherit}.jwplayer.jw-tab-focus:focus{outline:solid 2px #4d90fe}.jwplayer.jw-flag-aspect-mode{height:auto !important}.jwplayer.jw-flag-aspect-mode .jw-aspect{display:block}.jwplayer .jw-aspect{display:none}.jwplayer .jw-swf{outline:none}.jw-media,.jw-preview{position:absolute;width:100%;height:100%;top:0;left:0;bottom:0;right:0}.jw-media{overflow:hidden;cursor:pointer}.jw-plugin{position:absolute;bottom:66px}.jw-plugin .jw-banner{max-width:100%;opacity:0;cursor:pointer;position:absolute;margin:auto auto 0;left:0;right:0;bottom:0;display:block}.jw-preview,.jw-captions,.jw-title{pointer-events:none}.jw-media,.jw-logo{pointer-events:all}.jw-wrapper{background-color:#000;position:absolute;top:0;left:0;right:0;bottom:0}.jw-hidden-accessibility{border:0;clip:rect(0 0 0 0);height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;width:1px}.jwplayer video{position:absolute;top:0;right:0;bottom:0;left:0;width:100%;height:100%;margin:auto;background:transparent}.jwplayer video::-webkit-media-controls-start-playback-button{display:none}.jwplayer.jw-stretch-uniform video{object-fit:contain}.jwplayer.jw-stretch-none video{object-fit:none}.jwplayer.jw-stretch-fill video{object-fit:cover}.jwplayer.jw-stretch-exactfit video{object-fit:fill}.jw-preview{position:absolute;display:none;opacity:1;visibility:visible;width:100%;height:100%;background:#000 no-repeat 50% 50%}.jwplayer .jw-preview,.jw-error .jw-preview{background-size:contain}.jw-stretch-none .jw-preview{background-size:auto auto}.jw-stretch-fill .jw-preview{background-size:cover}.jw-stretch-exactfit .jw-preview{background-size:100% 100%}.jw-title{display:none;padding-top:20px;width:100%;z-index:1}.jw-title-primary,.jw-title-secondary{color:#fff;padding-left:20px;padding-right:20px;padding-bottom:.5em;overflow:hidden;text-overflow:ellipsis;direction:unset;white-space:nowrap;width:100%}.jw-title-primary{font-size:1.625em}.jw-breakpoint-2 .jw-title-primary,.jw-breakpoint-3 .jw-title-primary{font-size:1.5em}.jw-flag-small-player .jw-title-primary{font-size:1.25em}.jw-flag-small-player .jw-title-secondary,.jw-title-secondary:empty{display:none}.jw-captions{position:absolute;width:100%;height:100%;text-align:center;display:none;max-height:calc(100% - 60px);letter-spacing:normal;word-spacing:normal;text-transform:none;text-indent:0;text-decoration:none;pointer-events:none;overflow:hidden;top:0}.jw-captions.jw-captions-enabled{display:block}.jw-captions-window{display:none;padding:.25em;border-radius:.25em}.jw-captions-window.jw-captions-window-active{display:inline-block}.jw-captions-text{display:inline-block;color:#fff;background-color:#000;word-wrap:normal;word-break:normal;white-space:pre-line;font-style:normal;font-weight:normal;text-align:center;text-decoration:none}.jw-text-track-display{font-size:inherit;line-height:1.5}.jw-text-track-cue{background-color:rgba(0,0,0,0.5);color:#fff;padding:.1em .3em}.jwplayer video::-webkit-media-controls{display:none;justify-content:flex-start}.jwplayer video::-webkit-media-text-track-container{max-height:calc(100% - 60px);line-height:normal}.jwplayer video::-webkit-media-text-track-display{min-width:-webkit-min-content}.jwplayer video::cue{background-color:rgba(0,0,0,0.5)}.jwplayer video::-webkit-media-controls-panel-container{display:none}.jw-logo{position:absolute;margin:20px;cursor:pointer;pointer-events:all;background-repeat:no-repeat;background-size:contain;top:auto;right:auto;left:auto;bottom:auto;outline:none}.jw-logo.jw-tab-focus:focus{outline:solid 2px #4d90fe}.jw-flag-audio-player .jw-logo{display:none}.jw-logo-top-right{top:0;right:0}.jw-logo-top-left{top:0;left:0}.jw-logo-bottom-left{left:0}.jw-logo-bottom-right{right:0}.jw-logo-bottom-left,.jw-logo-bottom-right{bottom:44px;transition:bottom 150ms cubic-bezier(0, .25, .25, 1)}.jw-state-idle .jw-logo{z-index:1}.jw-state-setup .jw-wrapper{background-color:inherit}.jw-state-setup .jw-logo,.jw-state-setup .jw-controls,.jw-state-setup .jw-controls-backdrop{visibility:hidden}span.jw-break{display:block}body .jw-error,body .jwplayer.jw-state-error{background-color:#333;color:#fff;font-size:16px;display:table;opacity:1;position:relative}body .jw-error .jw-display,body .jwplayer.jw-state-error .jw-display{display:none}body .jw-error .jw-media,body .jwplayer.jw-state-error .jw-media{cursor:default}body .jw-error .jw-preview,body .jwplayer.jw-state-error .jw-preview{background-color:#333}body .jw-error .jw-error-msg,body .jwplayer.jw-state-error .jw-error-msg{background-color:#000;border-radius:2px;display:flex;flex-direction:row;align-items:stretch;padding:20px}body .jw-error .jw-error-msg .jw-icon,body .jwplayer.jw-state-error .jw-error-msg .jw-icon{height:30px;width:30px;margin-right:20px;flex:0 0 auto;align-self:center}body .jw-error .jw-error-msg .jw-icon:empty,body .jwplayer.jw-state-error .jw-error-msg .jw-icon:empty{display:none}body .jw-error .jw-error-msg .jw-info-container,body .jwplayer.jw-state-error .jw-error-msg .jw-info-container{margin:0;padding:0}body .jw-error:not(.jw-flag-audio-player).jw-flag-small-player .jw-error-msg,body .jwplayer.jw-state-error:not(.jw-flag-audio-player).jw-flag-small-player .jw-error-msg,body .jw-error:not(.jw-flag-audio-player).jw-breakpoint-2 .jw-error-msg,body .jwplayer.jw-state-error:not(.jw-flag-audio-player).jw-breakpoint-2 .jw-error-msg{flex-direction:column}body .jw-error:not(.jw-flag-audio-player).jw-flag-small-player .jw-error-msg .jw-error-text,body .jwplayer.jw-state-error:not(.jw-flag-audio-player).jw-flag-small-player .jw-error-msg .jw-error-text,body .jw-error:not(.jw-flag-audio-player).jw-breakpoint-2 .jw-error-msg .jw-error-text,body .jwplayer.jw-state-error:not(.jw-flag-audio-player).jw-breakpoint-2 .jw-error-msg .jw-error-text{text-align:center}body .jw-error:not(.jw-flag-audio-player).jw-flag-small-player .jw-error-msg .jw-icon,body .jwplayer.jw-state-error:not(.jw-flag-audio-player).jw-flag-small-player .jw-error-msg .jw-icon,body .jw-error:not(.jw-flag-audio-player).jw-breakpoint-2 .jw-error-msg .jw-icon,body .jwplayer.jw-state-error:not(.jw-flag-audio-player).jw-breakpoint-2 .jw-error-msg .jw-icon{flex:.5 0 auto;margin-right:0;margin-bottom:20px}.jwplayer.jw-state-error.jw-flag-audio-player .jw-error-msg .jw-break,.jwplayer.jw-state-error.jw-flag-small-player .jw-error-msg .jw-break,.jwplayer.jw-state-error.jw-breakpoint-2 .jw-error-msg .jw-break{display:inline}.jwplayer.jw-state-error.jw-flag-audio-player .jw-error-msg .jw-break:before,.jwplayer.jw-state-error.jw-flag-small-player .jw-error-msg .jw-break:before,.jwplayer.jw-state-error.jw-breakpoint-2 .jw-error-msg .jw-break:before{content:" "}.jwplayer.jw-state-error.jw-flag-audio-player .jw-error-msg{height:100%;width:100%;top:0;position:absolute;left:0;background:#000;-webkit-transform:none;transform:none;padding:4px 16px;z-index:1}.jwplayer.jw-state-error.jw-flag-audio-player .jw-error-msg.jw-info-overlay{max-width:none;max-height:none}body .jwplayer.jw-state-error .jw-title,.jw-state-idle .jw-title,.jwplayer.jw-state-complete:not(.jw-flag-casting):not(.jw-flag-audio-player):not(.jw-flag-overlay-open-related) .jw-title{display:block}body .jwplayer.jw-state-error .jw-preview,.jw-state-idle .jw-preview,.jwplayer.jw-state-complete:not(.jw-flag-casting):not(.jw-flag-audio-player):not(.jw-flag-overlay-open-related) .jw-preview{display:block}.jw-state-idle .jw-captions,.jwplayer.jw-state-complete .jw-captions,body .jwplayer.jw-state-error .jw-captions{display:none}.jw-state-idle video::-webkit-media-text-track-container,.jwplayer.jw-state-complete video::-webkit-media-text-track-container,body .jwplayer.jw-state-error video::-webkit-media-text-track-container{display:none}.jwplayer.jw-flag-fullscreen{width:100% !important;height:100% !important;top:0;right:0;bottom:0;left:0;z-index:1000;margin:0;position:fixed}body .jwplayer.jw-flag-flash-blocked .jw-title{display:block}.jwplayer.jw-flag-controls-hidden .jw-captions{max-height:none}.jwplayer.jw-flag-controls-hidden video::-webkit-media-text-track-container{max-height:none}.jwplayer.jw-flag-controls-hidden .jw-media{cursor:default}.jw-flag-audio-player:not(.jw-flag-flash-blocked) .jw-media{visibility:hidden}.jw-flag-audio-player .jw-title{background:none}.jw-flag-audio-player object{min-height:45px}.jw-flag-floating{background-size:cover;background-color:#000}.jw-flag-floating .jw-wrapper{position:fixed;z-index:2147483647;-webkit-animation:jw-float-to-bottom 150ms cubic-bezier(0, .25, .25, 1) forwards 1;animation:jw-float-to-bottom 150ms cubic-bezier(0, .25, .25, 1) forwards 1;top:auto;bottom:1rem;left:auto;right:1rem;max-width:400px;height:30%;max-height:400px;margin:0 auto}@media screen and (max-width:480px){.jw-flag-floating .jw-wrapper{width:100%;left:0;right:0}}@media screen and (max-device-width:480px) and (orientation:portrait){.jw-flag-touch.jw-flag-floating .jw-wrapper{-webkit-animation:jw-float-to-top 150ms cubic-bezier(0, .25, .25, 1) forwards 1;animation:jw-float-to-top 150ms cubic-bezier(0, .25, .25, 1) forwards 1;top:62px;bottom:auto;left:0;right:0;max-width:none;max-height:none}}.jw-flag-floating .jw-float-icon{pointer-events:all;cursor:pointer;display:none}.jw-flag-floating .jw-float-icon .jw-svg-icon{-webkit-filter:drop-shadow(0 0 1px #000);filter:drop-shadow(0 0 1px #000)}.jw-flag-floating.jw-floating-dismissible .jw-dismiss-icon{display:none}.jw-flag-floating.jw-floating-dismissible.jw-state-paused .jw-float-icon,.jw-flag-floating.jw-floating-dismissible:not(.jw-flag-user-inactive) .jw-float-icon{display:flex}.jw-flag-floating.jw-floating-dismissible.jw-state-paused .jw-logo,.jw-flag-floating.jw-floating-dismissible:not(.jw-flag-user-inactive) .jw-logo{display:none}.jw-float-icon{display:none;position:absolute;top:3px;right:5px;align-items:center;justify-content:center}@-webkit-keyframes jw-float-to-bottom{from{-webkit-transform:translateY(100%);transform:translateY(100%)}to{-webkit-transform:translateY(0);transform:translateY(0)}}@keyframes jw-float-to-bottom{from{-webkit-transform:translateY(100%);transform:translateY(100%)}to{-webkit-transform:translateY(0);transform:translateY(0)}}@-webkit-keyframes jw-float-to-top{from{-webkit-transform:translateY(-100%);transform:translateY(-100%)}to{-webkit-transform:translateY(0);transform:translateY(0)}}@keyframes jw-float-to-top{from{-webkit-transform:translateY(-100%);transform:translateY(-100%)}to{-webkit-transform:translateY(0);transform:translateY(0)}}.jw-flag-top{margin-top:2em;overflow:visible}.jw-top{height:2em;line-height:2;pointer-events:none;text-align:center;opacity:.8;position:absolute;top:-2em;width:100%}.jw-top .jw-icon{cursor:pointer;pointer-events:all;height:auto;width:auto}.jw-top .jw-text{color:#555}', ""])
    }, function(e, t, i) {
        var n = i(109);
        "string" == typeof n && (n = [
            ["all-players", n, ""]
        ]), i(41).style(n, "all-players"), n.locals && (e.exports = n.locals)
    }, function(e, t, i) {
        (e.exports = i(64)(!1)).push([e.i, ".jw-flag-outstream.jw-state-complete .jw-controls,.jw-flag-outstream.jw-state-complete .jw-controls-backdrop{display:none}.jw-flag-outstream.jw-state-complete .jw-media{pointer-events:none}.jw-flag-outstream.jw-state-complete .jw-preview{background-color:#f2f2f2}.jw-flag-outstream .jw-wrapper{transition:-webkit-transform 250ms cubic-bezier(0, .25, .25, 1);transition:transform 250ms cubic-bezier(0, .25, .25, 1);transition:transform 250ms cubic-bezier(0, .25, .25, 1), -webkit-transform 250ms cubic-bezier(0, .25, .25, 1)}.jw-flag-outstream .jw-dismiss-icon{position:absolute;right:0;bottom:0}.jw-flag-outstream-close{max-height:1px;-webkit-animation:250ms jw-outstream-collapse 1 step-end;animation:250ms jw-outstream-collapse 1 step-end}@-webkit-keyframes jw-outstream-collapse{0%{max-height:initial}100%{max-height:1px}}@keyframes jw-outstream-collapse{0%{max-height:initial}100%{max-height:1px}}.jw-flag-outstream-close .jw-wrapper{-webkit-transform:scaleY(0);transform:scaleY(0)}.jw-flag-outstream-pending{max-height:1px}.jw-flag-outstream-pending.jw-flag-top{margin-top:0;overflow:hidden}.jw-flag-outstream-pending .jw-wrapper{-webkit-transform:scaleY(0);transform:scaleY(0)}", ""])
    }, function(e, t, i) {
        var n = i(111);
        "string" == typeof n && (n = [
            ["all-players", n, ""]
        ]), i(41).style(n, "all-players"), n.locals && (e.exports = n.locals)
    }, function(e, t, i) {
        (e.exports = i(64)(!1)).push([e.i, '.jw-overlays,.jw-controls,.jw-controls-backdrop,.jw-flag-small-player .jw-settings-menu,.jw-settings-submenu{height:100%;width:100%}.jw-settings-menu .jw-icon::after,.jw-icon-settings::after,.jw-icon-volume::after,.jw-settings-menu .jw-icon.jw-button-color::after{position:absolute;right:0}.jw-overlays,.jw-controls,.jw-controls-backdrop,.jw-settings-item-active::before{top:0;position:absolute;left:0}.jw-settings-menu .jw-icon::after,.jw-icon-settings::after,.jw-icon-volume::after,.jw-settings-menu .jw-icon.jw-button-color::after{position:absolute;bottom:0;left:0}.jw-nextup-close{position:absolute;top:0;right:0}.jw-overlays,.jw-controls,.jw-flag-small-player .jw-settings-menu{position:absolute;bottom:0;right:0}.jw-settings-menu .jw-icon::after,.jw-icon-settings::after,.jw-icon-volume::after,.jw-time-tip::after,.jw-settings-menu .jw-icon.jw-button-color::after,.jw-text-live::before,.jw-controlbar .jw-tooltip::after,.jw-settings-menu .jw-tooltip::after{content:"";display:block}.jw-svg-icon{height:24px;width:24px;fill:currentColor;pointer-events:none}.jw-icon{height:44px;width:44px;background-color:transparent;outline:none}.jw-icon.jw-tab-focus:focus{border:solid 2px #4d90fe}.jw-icon-airplay .jw-svg-icon-airplay-off{display:none}.jw-off.jw-icon-airplay .jw-svg-icon-airplay-off{display:block}.jw-icon-airplay .jw-svg-icon-airplay-on{display:block}.jw-off.jw-icon-airplay .jw-svg-icon-airplay-on{display:none}.jw-icon-cc .jw-svg-icon-cc-off{display:none}.jw-off.jw-icon-cc .jw-svg-icon-cc-off{display:block}.jw-icon-cc .jw-svg-icon-cc-on{display:block}.jw-off.jw-icon-cc .jw-svg-icon-cc-on{display:none}.jw-icon-fullscreen .jw-svg-icon-fullscreen-off{display:none}.jw-off.jw-icon-fullscreen .jw-svg-icon-fullscreen-off{display:block}.jw-icon-fullscreen .jw-svg-icon-fullscreen-on{display:block}.jw-off.jw-icon-fullscreen .jw-svg-icon-fullscreen-on{display:none}.jw-icon-volume .jw-svg-icon-volume-0{display:none}.jw-off.jw-icon-volume .jw-svg-icon-volume-0{display:block}.jw-icon-volume .jw-svg-icon-volume-100{display:none}.jw-full.jw-icon-volume .jw-svg-icon-volume-100{display:block}.jw-icon-volume .jw-svg-icon-volume-50{display:block}.jw-off.jw-icon-volume .jw-svg-icon-volume-50,.jw-full.jw-icon-volume .jw-svg-icon-volume-50{display:none}.jw-settings-menu .jw-icon::after,.jw-icon-settings::after,.jw-icon-volume::after{height:100%;width:24px;box-shadow:inset 0 -3px 0 -1px currentColor;margin:auto;opacity:0;transition:opacity 150ms cubic-bezier(0, .25, .25, 1)}.jw-settings-menu .jw-icon[aria-checked="true"]::after,.jw-settings-open .jw-icon-settings::after,.jw-icon-volume.jw-open::after{opacity:1}.jw-overlays,.jw-controls{pointer-events:none}.jw-controls-backdrop{display:block;background:linear-gradient(to bottom, transparent, rgba(0,0,0,0.4) 77%, rgba(0,0,0,0.4) 100%) 100% 100% / 100% 240px no-repeat transparent;transition:opacity 250ms cubic-bezier(0, .25, .25, 1),background-size 250ms cubic-bezier(0, .25, .25, 1);pointer-events:none}.jw-overlays{cursor:auto}.jw-controls{overflow:hidden}.jw-flag-small-player .jw-controls{text-align:center}.jw-text{height:1em;font-family:Arial,Helvetica,sans-serif;font-size:.75em;font-style:normal;font-weight:normal;color:#fff;text-align:center;font-variant:normal;font-stretch:normal}.jw-controlbar,.jw-skip,.jw-display-icon-container .jw-icon,.jw-nextup-container,.jw-autostart-mute,.jw-overlays .jw-plugin{pointer-events:all}.jwplayer .jw-display-icon-container,.jw-error .jw-display-icon-container{width:auto;height:auto;box-sizing:content-box}.jw-display{display:table;height:100%;padding:57px 0;position:relative;width:100%}.jw-flag-dragging .jw-display{display:none}.jw-state-idle:not(.jw-flag-cast-available) .jw-display{padding:0}.jw-display-container{display:table-cell;height:100%;text-align:center;vertical-align:middle}.jw-display-controls{display:inline-block}.jw-display-icon-container{display:inline-block;padding:5.5px;margin:0 22px}.jw-display-icon-container .jw-icon{height:75px;width:75px;cursor:pointer;display:flex;justify-content:center;align-items:center}.jw-display-icon-container .jw-icon .jw-svg-icon{height:33px;width:33px;padding:0;position:relative}.jw-display-icon-container .jw-icon .jw-svg-icon-rewind{padding:.2em .05em}.jw-breakpoint-0 .jw-display-icon-next,.jw-breakpoint-0 .jw-display-icon-rewind{display:none}.jw-breakpoint-0 .jw-display .jw-icon,.jw-breakpoint-0 .jw-display .jw-svg-icon{width:44px;height:44px;line-height:44px}.jw-breakpoint-0 .jw-display .jw-icon:before,.jw-breakpoint-0 .jw-display .jw-svg-icon:before{width:22px;height:22px}.jw-breakpoint-1 .jw-display .jw-icon,.jw-breakpoint-1 .jw-display .jw-svg-icon{width:44px;height:44px;line-height:44px}.jw-breakpoint-1 .jw-display .jw-icon:before,.jw-breakpoint-1 .jw-display .jw-svg-icon:before{width:22px;height:22px}.jw-breakpoint-1 .jw-display .jw-icon.jw-icon-rewind:before{width:33px;height:33px}.jw-breakpoint-2 .jw-display .jw-icon,.jw-breakpoint-3 .jw-display .jw-icon,.jw-breakpoint-2 .jw-display .jw-svg-icon,.jw-breakpoint-3 .jw-display .jw-svg-icon{width:77px;height:77px;line-height:77px}.jw-breakpoint-2 .jw-display .jw-icon:before,.jw-breakpoint-3 .jw-display .jw-icon:before,.jw-breakpoint-2 .jw-display .jw-svg-icon:before,.jw-breakpoint-3 .jw-display .jw-svg-icon:before{width:38.5px;height:38.5px}.jw-breakpoint-4 .jw-display .jw-icon,.jw-breakpoint-5 .jw-display .jw-icon,.jw-breakpoint-6 .jw-display .jw-icon,.jw-breakpoint-7 .jw-display .jw-icon,.jw-breakpoint-4 .jw-display .jw-svg-icon,.jw-breakpoint-5 .jw-display .jw-svg-icon,.jw-breakpoint-6 .jw-display .jw-svg-icon,.jw-breakpoint-7 .jw-display .jw-svg-icon{width:88px;height:88px;line-height:88px}.jw-breakpoint-4 .jw-display .jw-icon:before,.jw-breakpoint-5 .jw-display .jw-icon:before,.jw-breakpoint-6 .jw-display .jw-icon:before,.jw-breakpoint-7 .jw-display .jw-icon:before,.jw-breakpoint-4 .jw-display .jw-svg-icon:before,.jw-breakpoint-5 .jw-display .jw-svg-icon:before,.jw-breakpoint-6 .jw-display .jw-svg-icon:before,.jw-breakpoint-7 .jw-display .jw-svg-icon:before{width:44px;height:44px}.jw-controlbar{display:flex;flex-flow:row wrap;align-items:center;justify-content:center;position:absolute;left:0;bottom:0;width:100%;border:none;border-radius:0;background-size:auto;box-shadow:none;max-height:72px;transition:250ms cubic-bezier(0, .25, .25, 1);transition-property:opacity, visibility;transition-delay:0s}.jw-controlbar .jw-button-image{background:no-repeat 50% 50%;background-size:contain;max-height:24px}.jw-controlbar .jw-spacer{flex:1 1 auto;align-self:stretch}.jw-controlbar .jw-icon.jw-button-color:hover{color:#fff}.jw-button-container{display:flex;flex-flow:row nowrap;flex:1 1 auto;align-items:center;justify-content:center;width:100%;padding:0 12px}.jw-slider-horizontal{background-color:transparent}.jw-icon-inline{position:relative}.jw-icon-inline,.jw-icon-tooltip{height:44px;width:44px;align-items:center;display:flex;justify-content:center}.jw-icon-inline:not(.jw-text),.jw-icon-tooltip,.jw-slider-horizontal{cursor:pointer}.jw-text-elapsed,.jw-text-duration{justify-content:flex-start;width:-webkit-fit-content;width:-moz-fit-content;width:fit-content}.jw-icon-tooltip{position:relative}.jw-knob:hover,.jw-icon-inline:hover,.jw-icon-tooltip:hover,.jw-icon-display:hover,.jw-option:before:hover{color:#fff}.jw-time-tip,.jw-controlbar .jw-tooltip,.jw-settings-menu .jw-tooltip{pointer-events:none}.jw-icon-cast{display:none;margin:0;padding:0}.jw-icon-cast google-cast-launcher{background-color:transparent;border:none;padding:0;width:24px;height:24px;cursor:pointer}.jw-icon-inline.jw-icon-volume{display:none}.jwplayer .jw-text-countdown{display:none}.jw-flag-small-player .jw-display{padding-top:44px;padding-bottom:66px}.jw-flag-small-player:not(.jw-flag-audio-player):not(.jw-flag-ads) .jw-controlbar .jw-button-container>.jw-icon-rewind,.jw-flag-small-player:not(.jw-flag-audio-player):not(.jw-flag-ads) .jw-controlbar .jw-button-container>.jw-icon-next,.jw-flag-small-player:not(.jw-flag-audio-player):not(.jw-flag-ads) .jw-controlbar .jw-button-container>.jw-icon-playback{display:none}.jw-flag-ads-vpaid:not(.jw-flag-media-audio):not(.jw-flag-audio-player):not(.jw-flag-ads-vpaid-controls):not(.jw-flag-casting) .jw-controlbar,.jw-flag-user-inactive.jw-state-playing:not(.jw-flag-media-audio):not(.jw-flag-audio-player):not(.jw-flag-ads-vpaid-controls):not(.jw-flag-casting) .jw-controlbar,.jw-flag-user-inactive.jw-state-buffering:not(.jw-flag-media-audio):not(.jw-flag-audio-player):not(.jw-flag-ads-vpaid-controls):not(.jw-flag-casting) .jw-controlbar{visibility:hidden;pointer-events:none;opacity:0;transition-delay:0s, 250ms}.jw-flag-ads-vpaid:not(.jw-flag-media-audio):not(.jw-flag-audio-player):not(.jw-flag-ads-vpaid-controls):not(.jw-flag-casting) .jw-controls-backdrop,.jw-flag-user-inactive.jw-state-playing:not(.jw-flag-media-audio):not(.jw-flag-audio-player):not(.jw-flag-ads-vpaid-controls):not(.jw-flag-casting) .jw-controls-backdrop,.jw-flag-user-inactive.jw-state-buffering:not(.jw-flag-media-audio):not(.jw-flag-audio-player):not(.jw-flag-ads-vpaid-controls):not(.jw-flag-casting) .jw-controls-backdrop{opacity:0}.jwplayer:not(.jw-flag-ads):not(.jw-flag-live).jw-breakpoint-0 .jw-text-countdown{display:flex}.jwplayer:not(.jw-flag-ads):not(.jw-flag-live).jw-breakpoint-0 .jw-text-elapsed,.jwplayer:not(.jw-flag-ads):not(.jw-flag-live).jw-breakpoint-0 .jw-text-duration{display:none}.jwplayer:not(.jw-breakpoint-0) .jw-text-duration:before{content:"/";padding-right:1ch;padding-left:1ch}.jwplayer:not(.jw-flag-user-inactive) .jw-controlbar{will-change:transform}.jwplayer:not(.jw-flag-user-inactive) .jw-controlbar .jw-text{-webkit-transform-style:preserve-3d;transform-style:preserve-3d}.jw-slider-container{display:flex;align-items:center;position:relative;touch-action:none}.jw-rail,.jw-buffer,.jw-progress{position:absolute;cursor:pointer}.jw-progress{background-color:#f2f2f2}.jw-rail{background-color:rgba(255,255,255,0.3)}.jw-buffer{background-color:rgba(255,255,255,0.3)}.jw-knob{height:13px;width:13px;background-color:#fff;border-radius:50%;box-shadow:0 0 10px rgba(0,0,0,0.4);opacity:1;pointer-events:none;position:absolute;-webkit-transform:translate(-50%, -50%) scale(0);transform:translate(-50%, -50%) scale(0);transition:150ms cubic-bezier(0, .25, .25, 1);transition-property:opacity, -webkit-transform;transition-property:opacity, transform;transition-property:opacity, transform, -webkit-transform}.jw-flag-dragging .jw-slider-time .jw-knob,.jw-icon-volume:active .jw-slider-volume .jw-knob{box-shadow:0 0 26px rgba(0,0,0,0.2),0 0 10px rgba(0,0,0,0.4),0 0 0 6px rgba(255,255,255,0.2)}.jw-slider-horizontal,.jw-slider-vertical{display:flex}.jw-slider-horizontal .jw-slider-container{height:5px;width:100%}.jw-slider-horizontal .jw-rail,.jw-slider-horizontal .jw-buffer,.jw-slider-horizontal .jw-progress,.jw-slider-horizontal .jw-cue,.jw-slider-horizontal .jw-knob{top:50%}.jw-slider-horizontal .jw-rail,.jw-slider-horizontal .jw-buffer,.jw-slider-horizontal .jw-progress,.jw-slider-horizontal .jw-cue{-webkit-transform:translate(0, -50%);transform:translate(0, -50%)}.jw-slider-horizontal .jw-rail,.jw-slider-horizontal .jw-buffer,.jw-slider-horizontal .jw-progress{height:5px}.jw-slider-horizontal .jw-rail{width:100%}.jw-slider-vertical{align-items:center;flex-direction:column}.jw-slider-vertical .jw-slider-container{height:88px;width:5px}.jw-slider-vertical .jw-rail,.jw-slider-vertical .jw-buffer,.jw-slider-vertical .jw-progress,.jw-slider-vertical .jw-knob{left:50%}.jw-slider-vertical .jw-rail,.jw-slider-vertical .jw-buffer,.jw-slider-vertical .jw-progress{height:100%;width:5px;-webkit-backface-visibility:hidden;backface-visibility:hidden;-webkit-transform:translate(-50%, 0);transform:translate(-50%, 0);transition:-webkit-transform 150ms ease-in-out;transition:transform 150ms ease-in-out;transition:transform 150ms ease-in-out, -webkit-transform 150ms ease-in-out;bottom:0}.jw-slider-vertical .jw-knob{-webkit-transform:translate(-50%, 50%);transform:translate(-50%, 50%)}.jw-slider-time.jw-tab-focus:focus .jw-rail{outline:solid 2px #4d90fe}.jw-slider-time,.jw-flag-audio-player .jw-slider-volume{height:17px;width:100%;align-items:center;background:transparent none;padding:0 12px}.jw-slider-time .jw-cue{background-color:rgba(33,33,33,0.8);cursor:pointer;position:absolute;width:6px}.jw-slider-time,.jw-horizontal-volume-container{z-index:1;outline:none}.jw-slider-time .jw-rail,.jw-horizontal-volume-container .jw-rail,.jw-slider-time .jw-buffer,.jw-horizontal-volume-container .jw-buffer,.jw-slider-time .jw-progress,.jw-horizontal-volume-container .jw-progress,.jw-slider-time .jw-cue,.jw-horizontal-volume-container .jw-cue{-webkit-backface-visibility:hidden;backface-visibility:hidden;height:100%;-webkit-transform:translate(0, -50%) scale(1, .6);transform:translate(0, -50%) scale(1, .6);transition:-webkit-transform 150ms ease-in-out;transition:transform 150ms ease-in-out;transition:transform 150ms ease-in-out, -webkit-transform 150ms ease-in-out}.jw-slider-time:hover .jw-rail,.jw-horizontal-volume-container:hover .jw-rail,.jw-slider-time:focus .jw-rail,.jw-horizontal-volume-container:focus .jw-rail,.jw-flag-dragging .jw-slider-time .jw-rail,.jw-flag-dragging .jw-horizontal-volume-container .jw-rail,.jw-flag-touch .jw-slider-time .jw-rail,.jw-flag-touch .jw-horizontal-volume-container .jw-rail,.jw-slider-time:hover .jw-buffer,.jw-horizontal-volume-container:hover .jw-buffer,.jw-slider-time:focus .jw-buffer,.jw-horizontal-volume-container:focus .jw-buffer,.jw-flag-dragging .jw-slider-time .jw-buffer,.jw-flag-dragging .jw-horizontal-volume-container .jw-buffer,.jw-flag-touch .jw-slider-time .jw-buffer,.jw-flag-touch .jw-horizontal-volume-container .jw-buffer,.jw-slider-time:hover .jw-progress,.jw-horizontal-volume-container:hover .jw-progress,.jw-slider-time:focus .jw-progress,.jw-horizontal-volume-container:focus .jw-progress,.jw-flag-dragging .jw-slider-time .jw-progress,.jw-flag-dragging .jw-horizontal-volume-container .jw-progress,.jw-flag-touch .jw-slider-time .jw-progress,.jw-flag-touch .jw-horizontal-volume-container .jw-progress,.jw-slider-time:hover .jw-cue,.jw-horizontal-volume-container:hover .jw-cue,.jw-slider-time:focus .jw-cue,.jw-horizontal-volume-container:focus .jw-cue,.jw-flag-dragging .jw-slider-time .jw-cue,.jw-flag-dragging .jw-horizontal-volume-container .jw-cue,.jw-flag-touch .jw-slider-time .jw-cue,.jw-flag-touch .jw-horizontal-volume-container .jw-cue{-webkit-transform:translate(0, -50%) scale(1, 1);transform:translate(0, -50%) scale(1, 1)}.jw-slider-time:hover .jw-knob,.jw-horizontal-volume-container:hover .jw-knob,.jw-slider-time:focus .jw-knob,.jw-horizontal-volume-container:focus .jw-knob,.jw-flag-dragging .jw-slider-time .jw-knob,.jw-flag-dragging .jw-horizontal-volume-container .jw-knob,.jw-flag-touch .jw-slider-time .jw-knob,.jw-flag-touch .jw-horizontal-volume-container .jw-knob{-webkit-transform:translate(-50%, -50%) scale(1);transform:translate(-50%, -50%) scale(1)}.jw-slider-time .jw-rail,.jw-horizontal-volume-container .jw-rail{background-color:rgba(255,255,255,0.2)}.jw-slider-time .jw-buffer,.jw-horizontal-volume-container .jw-buffer{background-color:rgba(255,255,255,0.4)}.jw-flag-touch .jw-slider-time::before,.jw-flag-touch .jw-horizontal-volume-container::before{height:44px;width:100%;content:"";position:absolute;display:block;bottom:calc(100% - 17px);left:0}.jw-slider-time.jw-tab-focus:focus .jw-rail,.jw-horizontal-volume-container.jw-tab-focus:focus .jw-rail{outline:solid 2px #4d90fe}.jw-modal{width:284px}.jw-breakpoint-7 .jw-modal,.jw-breakpoint-6 .jw-modal,.jw-breakpoint-5 .jw-modal{height:232px}.jw-breakpoint-4 .jw-modal,.jw-breakpoint-3 .jw-modal{height:192px}.jw-breakpoint-2 .jw-modal,.jw-flag-small-player .jw-modal{bottom:0;right:0;height:100%;width:100%;max-height:none;max-width:none;z-index:1}.jwplayer .jw-rightclick{display:none;position:absolute;white-space:nowrap}.jwplayer .jw-rightclick.jw-open{display:block}.jwplayer .jw-rightclick .jw-rightclick-list{border-radius:1px;list-style:none;margin:0;padding:0}.jwplayer .jw-rightclick .jw-rightclick-list .jw-rightclick-item{background-color:rgba(0,0,0,0.8);border-bottom:1px solid #444;margin:0}.jwplayer .jw-rightclick .jw-rightclick-list .jw-rightclick-item .jw-rightclick-logo{color:#fff;display:inline-flex;padding:0 10px 0 0;vertical-align:middle}.jwplayer .jw-rightclick .jw-rightclick-list .jw-rightclick-item .jw-rightclick-logo .jw-svg-icon{height:20px;width:20px}.jwplayer .jw-rightclick .jw-rightclick-list .jw-rightclick-item .jw-rightclick-link{border:none;color:#fff;display:block;font-size:11px;line-height:1em;padding:15px 23px;text-decoration:none}.jwplayer .jw-rightclick .jw-rightclick-list .jw-rightclick-item:last-child{border-bottom:none}.jwplayer .jw-rightclick .jw-rightclick-list .jw-rightclick-item:hover{cursor:pointer}.jwplayer .jw-rightclick .jw-rightclick-list .jw-featured{vertical-align:middle}.jwplayer .jw-rightclick .jw-rightclick-list .jw-featured .jw-rightclick-link{color:#fff}.jwplayer .jw-rightclick .jw-rightclick-list .jw-featured .jw-rightclick-link span{color:#fff}.jwplayer .jw-rightclick .jw-info-overlay-item,.jwplayer .jw-rightclick .jw-share-item,.jwplayer .jw-rightclick .jw-shortcuts-item{border:none;background-color:transparent;outline:none;cursor:pointer}.jw-icon-tooltip.jw-open .jw-overlay{opacity:1;transition-delay:0s;visibility:visible}.jw-icon-tooltip.jw-open .jw-overlay:focus{outline:none}.jw-icon-tooltip.jw-open .jw-overlay:focus.jw-tab-focus{outline:solid 2px #4d90fe}.jw-slider-time .jw-overlay:before{height:1em;top:auto}.jw-volume-tip{padding:13px 0 26px}.jw-time-tip,.jw-controlbar .jw-tooltip,.jw-settings-menu .jw-tooltip{height:auto;width:100%;box-shadow:0 0 10px rgba(0,0,0,0.4);color:#fff;display:block;margin:0 0 14px;pointer-events:none;position:relative;z-index:0}.jw-time-tip::after,.jw-controlbar .jw-tooltip::after,.jw-settings-menu .jw-tooltip::after{top:100%;position:absolute;left:50%;height:14px;width:14px;border-radius:1px;background-color:currentColor;-webkit-transform-origin:75% 50%;transform-origin:75% 50%;-webkit-transform:translate(-50%, -50%) rotate(45deg);transform:translate(-50%, -50%) rotate(45deg);z-index:-1}.jw-time-tip .jw-text,.jw-controlbar .jw-tooltip .jw-text,.jw-settings-menu .jw-tooltip .jw-text{background-color:#fff;border-radius:1px;color:#000;font-size:10px;height:auto;line-height:1;padding:7px 10px;display:inline-block;min-width:100%;vertical-align:middle}.jw-controlbar .jw-overlay{position:absolute;bottom:100%;left:50%;margin:0;min-height:44px;min-width:44px;opacity:0;transition:150ms cubic-bezier(0, .25, .25, 1);transition-property:opacity, visibility;transition-delay:0s, 150ms;-webkit-transform:translate(-50%, 0);transform:translate(-50%, 0);visibility:hidden;width:100%;z-index:1}.jw-controlbar .jw-overlay .jw-contents{position:relative}.jw-controlbar .jw-option{position:relative;white-space:nowrap;cursor:pointer;list-style:none;height:1.5em;font-family:inherit;line-height:1.5em;padding:0 .5em;font-size:.8em;margin:0}.jw-controlbar .jw-option::before{padding-right:.125em}.jw-controlbar .jw-tooltip,.jw-settings-menu .jw-tooltip{position:absolute;bottom:100%;left:50%;opacity:0;-webkit-transform:translate(-50%, 0);transform:translate(-50%, 0);transition:100ms 0s cubic-bezier(0, .25, .25, 1);transition-property:opacity, visibility, -webkit-transform;transition-property:opacity, transform, visibility;transition-property:opacity, transform, visibility, -webkit-transform;visibility:hidden;white-space:nowrap;width:auto;z-index:1}.jw-controlbar .jw-tooltip.jw-open,.jw-settings-menu .jw-tooltip.jw-open{opacity:1;-webkit-transform:translate(-50%, -10px);transform:translate(-50%, -10px);transition-duration:150ms;transition-delay:500ms,0s,500ms;visibility:visible}.jw-controlbar .jw-tooltip.jw-tooltip-fullscreen,.jw-settings-menu .jw-tooltip.jw-tooltip-fullscreen{left:auto;right:0;-webkit-transform:translate(0, 0);transform:translate(0, 0)}.jw-controlbar .jw-tooltip.jw-tooltip-fullscreen.jw-open,.jw-settings-menu .jw-tooltip.jw-tooltip-fullscreen.jw-open{-webkit-transform:translate(0, -10px);transform:translate(0, -10px)}.jw-controlbar .jw-tooltip.jw-tooltip-fullscreen::after,.jw-settings-menu .jw-tooltip.jw-tooltip-fullscreen::after{left:auto;right:9px}.jw-tooltip-time{height:auto;width:0;bottom:100%;line-height:normal;padding:0;pointer-events:none;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.jw-tooltip-time .jw-overlay{bottom:0;min-height:0;width:auto}.jw-tooltip{bottom:57px;display:none;position:absolute}.jw-tooltip .jw-text{height:100%;white-space:nowrap;text-overflow:ellipsis;direction:unset;max-width:246px;overflow:hidden}.jw-flag-audio-player .jw-tooltip{display:none}.jw-flag-small-player .jw-time-thumb{display:none}.jwplayer .jw-shortcuts-tooltip{top:50%;position:absolute;left:50%;background:#333;-webkit-transform:translate(-50%, -50%);transform:translate(-50%, -50%);display:none;color:#fff;pointer-events:all;-webkit-user-select:text;-moz-user-select:text;-ms-user-select:text;user-select:text;overflow:hidden;flex-direction:column}.jwplayer .jw-shortcuts-tooltip.jw-open{display:flex}.jwplayer .jw-shortcuts-tooltip .jw-shortcuts-close{flex:0 0 auto;margin:5px 5px 5px auto}.jwplayer .jw-shortcuts-tooltip .jw-shortcuts-close:focus{border:none;outline:none}.jwplayer .jw-shortcuts-tooltip .jw-shortcuts-container{display:flex;flex:1 1 auto;flex-flow:column;margin:0 20px 20px;overflow-y:auto;padding:5px}.jwplayer .jw-shortcuts-tooltip .jw-shortcuts-container::-webkit-scrollbar{background-color:transparent;width:6px}.jwplayer .jw-shortcuts-tooltip .jw-shortcuts-container::-webkit-scrollbar-thumb{background-color:#fff;border:1px solid #333;border-radius:6px}.jwplayer .jw-shortcuts-tooltip .jw-shortcuts-title{font-size:12px;font-weight:bold}.jwplayer .jw-shortcuts-tooltip .jw-shortcuts-tooltip-list{display:flex;max-width:340px}.jwplayer .jw-shortcuts-tooltip .jw-shortcuts-tooltip-list .jw-shortcuts-tooltip-descriptions{list-style:none;padding-left:0;font-size:12px;margin-right:20px;margin-left:10px;padding-top:5px}.jwplayer .jw-shortcuts-tooltip .jw-shortcuts-tooltip-list .jw-shortcuts-tooltip-keys{list-style:none;font-size:12px;padding-top:5px}.jwplayer .jw-shortcuts-tooltip .jw-shortcuts-tooltip-list .jw-shortcuts-tooltip-keys .jw-hotkey{color:#333;background:#fefefe;padding:7px 10px}.jwplayer .jw-shortcuts-tooltip .jw-shortcuts-tooltip-list .jw-shortcuts-tooltip-keys div,.jwplayer .jw-shortcuts-tooltip .jw-shortcuts-tooltip-list .jw-shortcuts-tooltip-descriptions div{line-height:34px}.jw-skip{color:rgba(255,255,255,0.8);cursor:default;position:absolute;display:flex;right:.75em;bottom:56px;padding:.5em;border:1px solid #333;background-color:#000;align-items:center;height:2em}.jw-skip.jw-tab-focus:focus{outline:solid 2px #4d90fe}.jw-skip.jw-skippable{cursor:pointer;padding:.25em .75em}.jw-skip.jw-skippable:hover{cursor:pointer;color:#fff}.jw-skip.jw-skippable .jw-skip-icon{display:inline;height:24px;width:24px;margin:0}.jw-skip .jw-skip-icon{display:none;margin-left:-0.75em;padding:0 .5em;pointer-events:none}.jw-skip .jw-skip-icon .jw-svg-icon-next{display:block;padding:0}.jw-skip .jw-text,.jw-skip .jw-skip-icon{vertical-align:middle;font-size:.7em}.jw-skip .jw-text{font-weight:bold}.jw-cast{background-size:cover;display:none;height:100%;position:relative;width:100%}.jw-cast-container{background:linear-gradient(180deg, rgba(25,25,25,0.75), rgba(25,25,25,0.25), rgba(25,25,25,0));left:0;padding:20px 20px 80px;position:absolute;top:0;width:100%}.jw-cast-text{color:#fff;font-size:1.6em}.jw-breakpoint-0 .jw-cast-text{font-size:1.15em}.jw-breakpoint-1 .jw-cast-text,.jw-breakpoint-2 .jw-cast-text,.jw-breakpoint-3 .jw-cast-text{font-size:1.3em}.jw-nextup-container{position:absolute;bottom:66px;left:0;background-color:transparent;cursor:pointer;margin:0 auto;padding:12px;pointer-events:none;right:0;text-align:right;visibility:hidden;width:100%}.jw-settings-open .jw-nextup-container,.jw-info-open .jw-nextup-container{display:none}.jw-flag-small-player .jw-nextup-container{padding:0 12px 0 0}.jw-flag-small-player .jw-nextup-container .jw-nextup-title,.jw-flag-small-player .jw-nextup-container .jw-nextup-duration,.jw-flag-small-player .jw-nextup-container .jw-nextup-close{display:none}.jw-flag-small-player .jw-nextup-container .jw-nextup-tooltip{height:30px}.jw-flag-small-player .jw-nextup-container .jw-nextup-header{font-size:12px}.jw-flag-small-player .jw-nextup-container .jw-nextup-body{justify-content:center;align-items:center;padding:.75em .3em}.jw-flag-small-player .jw-nextup-container .jw-nextup-thumbnail{width:50%}.jw-flag-small-player .jw-nextup-container .jw-nextup{max-width:65px}.jw-flag-small-player .jw-nextup-container .jw-nextup.jw-nextup-thumbnail-visible{max-width:120px}.jw-nextup{background:#333;border-radius:0;box-shadow:0 0 10px rgba(0,0,0,0.5);color:rgba(255,255,255,0.8);display:inline-block;max-width:280px;overflow:hidden;opacity:0;position:relative;width:64%;pointer-events:all;-webkit-transform:translate(0, -5px);transform:translate(0, -5px);transition:150ms cubic-bezier(0, .25, .25, 1);transition-property:opacity, -webkit-transform;transition-property:opacity, transform;transition-property:opacity, transform, -webkit-transform;transition-delay:0s}.jw-nextup:hover .jw-nextup-tooltip{color:#fff}.jw-nextup.jw-nextup-thumbnail-visible{max-width:400px}.jw-nextup.jw-nextup-thumbnail-visible .jw-nextup-thumbnail{display:block}.jw-nextup-container-visible{visibility:visible}.jw-nextup-container-visible .jw-nextup{opacity:1;-webkit-transform:translate(0, 0);transform:translate(0, 0);transition-delay:0s, 0s, 150ms}.jw-nextup-tooltip{display:flex;height:80px}.jw-nextup-thumbnail{width:120px;background-position:center;background-size:cover;flex:0 0 auto;display:none}.jw-nextup-body{flex:1 1 auto;overflow:hidden;padding:.75em .875em;display:flex;flex-flow:column wrap;justify-content:space-between}.jw-nextup-header,.jw-nextup-title{font-size:14px;line-height:1.35}.jw-nextup-header{font-weight:bold}.jw-nextup-title{overflow:hidden;text-overflow:ellipsis;white-space:nowrap;width:100%}.jw-nextup-duration{align-self:flex-end;text-align:right;font-size:12px}.jw-nextup-close{height:24px;width:24px;border:none;color:rgba(255,255,255,0.8);cursor:pointer;margin:6px;visibility:hidden}.jw-nextup-close:hover{color:#fff}.jw-nextup-sticky .jw-nextup-close{visibility:visible}.jw-autostart-mute{position:absolute;bottom:0;right:12px;height:44px;width:44px;background-color:rgba(33,33,33,0.4);padding:5px 4px 5px 6px;display:none}.jwplayer.jw-flag-autostart:not(.jw-flag-media-audio) .jw-nextup{display:none}.jw-settings-menu{position:absolute;bottom:57px;right:12px;align-items:flex-start;background-color:#333;display:none;flex-flow:column nowrap;max-width:284px;pointer-events:auto}.jw-settings-open .jw-settings-menu{display:flex}.jw-breakpoint-7 .jw-settings-menu,.jw-breakpoint-6 .jw-settings-menu,.jw-breakpoint-5 .jw-settings-menu{height:232px;width:284px;max-height:232px}.jw-breakpoint-4 .jw-settings-menu,.jw-breakpoint-3 .jw-settings-menu{height:192px;width:284px;max-height:192px}.jw-breakpoint-2 .jw-settings-menu{height:179px;width:284px;max-height:179px}.jw-flag-small-player .jw-settings-menu{max-width:none}.jw-settings-menu .jw-icon.jw-button-color::after{height:100%;width:24px;box-shadow:inset 0 -3px 0 -1px currentColor;margin:auto;opacity:0;transition:opacity 150ms cubic-bezier(0, .25, .25, 1)}.jw-settings-menu .jw-icon.jw-button-color[aria-checked="true"]::after{opacity:1}.jw-settings-topbar{align-items:center;background-color:rgba(0,0,0,0.4);display:flex;flex:0 0 auto;padding:3px 5px 0;width:100%}.jw-settings-topbar .jw-settings-close{margin-left:auto}.jw-settings-submenu{display:none;flex:1 1 auto;overflow-y:auto;padding:8px 20px 0 5px}.jw-settings-submenu::-webkit-scrollbar{background-color:transparent;width:6px}.jw-settings-submenu::-webkit-scrollbar-thumb{background-color:#fff;border:1px solid #333;border-radius:6px}.jw-settings-submenu.jw-settings-submenu-active{display:block}.jw-flag-touch .jw-settings-submenu{overflow-y:scroll;-webkit-overflow-scrolling:touch}.jw-auto-label{font-size:10px;font-weight:initial;opacity:.75;padding-left:5px}.jw-settings-content-item{position:relative;color:rgba(255,255,255,0.8);cursor:pointer;font-size:12px;line-height:1;padding:7px 0 7px 15px;width:100%;text-align:left;outline:none}.jw-settings-content-item:hover{color:#fff}.jw-settings-content-item:focus{font-weight:bold}.jw-flag-small-player .jw-settings-content-item{line-height:1.75}.jw-settings-content-item.jw-tab-focus:focus{border:solid 2px #4d90fe}.jw-settings-item-active{font-weight:bold;position:relative}.jw-settings-item-active::before{height:100%;width:1em;align-items:center;content:"\\2022";display:inline-flex;justify-content:center}.jw-breakpoint-2 .jw-settings-open .jw-display-container,.jw-flag-small-player .jw-settings-open .jw-display-container,.jw-flag-touch .jw-settings-open .jw-display-container{display:none}.jw-breakpoint-2 .jw-settings-open.jw-controls,.jw-flag-small-player .jw-settings-open.jw-controls,.jw-flag-touch .jw-settings-open.jw-controls{z-index:1}.jw-flag-small-player .jw-settings-open .jw-controlbar{display:none}.jw-settings-open .jw-icon-settings::after{opacity:1}.jw-settings-open .jw-tooltip-settings{display:none}.jw-sharing-link{cursor:pointer}.jw-idle-icon-text{display:none;line-height:1;position:absolute;text-align:center;text-indent:.35em;top:100%;white-space:nowrap;left:50%;-webkit-transform:translateX(-50%);transform:translateX(-50%)}.jw-idle-label{border-radius:50%;color:#fff;-webkit-filter:drop-shadow(1px 1px 5px rgba(12,26,71,0.25));filter:drop-shadow(1px 1px 5px rgba(12,26,71,0.25));font:normal 16px/1 Arial,Helvetica,sans-serif;position:relative;transition:background-color 150ms cubic-bezier(0, .25, .25, 1);transition-property:background-color,-webkit-filter;transition-property:background-color,filter;transition-property:background-color,filter,-webkit-filter;-webkit-font-smoothing:antialiased}.jw-state-idle .jw-icon-display.jw-idle-label .jw-idle-icon-text{display:block}.jw-state-idle .jw-icon-display.jw-idle-label .jw-svg-icon-play{-webkit-transform:scale(.7, .7);transform:scale(.7, .7)}.jw-breakpoint-0.jw-state-idle .jw-icon-display.jw-idle-label{font-size:12px}.jw-info-overlay{top:50%;position:absolute;left:50%;background:#333;-webkit-transform:translate(-50%, -50%);transform:translate(-50%, -50%);display:none;color:#fff;pointer-events:all;-webkit-user-select:text;-moz-user-select:text;-ms-user-select:text;user-select:text;overflow:hidden;flex-direction:column}.jw-info-overlay .jw-info-close{flex:0 0 auto;margin:5px 5px 5px auto}.jw-info-open .jw-info-overlay{display:flex}.jw-info-container{display:flex;flex:1 1 auto;flex-flow:column;margin:0 20px 20px;overflow-y:auto;padding:5px}.jw-info-container [class*="jw-info"]:not(:first-of-type){color:rgba(255,255,255,0.8);padding-top:10px;font-size:12px}.jw-info-container .jw-info-description{margin-bottom:30px}.jw-info-container .jw-info-description:empty{display:none}.jw-info-container .jw-info-title{font-size:12px;font-weight:bold}.jw-info-container::-webkit-scrollbar{background-color:transparent;width:6px}.jw-info-container::-webkit-scrollbar-thumb{background-color:#fff;border:1px solid #333;border-radius:6px}.jw-info-clientid{align-self:flex-end;font-size:12px;color:rgba(255,255,255,0.8);margin:0 20px 20px 44px;text-align:right}.jw-flag-touch .jw-info-open .jw-display-container{display:none}@supports ((-webkit-filter: drop-shadow(0 0 3px #000)) or (filter: drop-shadow(0 0 3px #000))){.jwplayer.jw-ab-drop-shadow .jw-controls .jw-svg-icon,.jwplayer.jw-ab-drop-shadow .jw-controls .jw-icon.jw-text,.jwplayer.jw-ab-drop-shadow .jw-slider-container .jw-rail,.jwplayer.jw-ab-drop-shadow .jw-title{text-shadow:none;box-shadow:none;-webkit-filter:drop-shadow(0 2px 3px rgba(0,0,0,0.3));filter:drop-shadow(0 2px 3px rgba(0,0,0,0.3))}.jwplayer.jw-ab-drop-shadow .jw-button-color{opacity:.8;transition-property:color, opacity}.jwplayer.jw-ab-drop-shadow .jw-button-color:not(:hover){color:#fff;opacity:.8}.jwplayer.jw-ab-drop-shadow .jw-button-color:hover{opacity:1}.jwplayer.jw-ab-drop-shadow .jw-controls-backdrop{background-image:linear-gradient(to bottom, hsla(0, 0%, 0%, 0), hsla(0, 0%, 0%, 0.00787) 10.79%, hsla(0, 0%, 0%, 0.02963) 21.99%, hsla(0, 0%, 0%, 0.0625) 33.34%, hsla(0, 0%, 0%, 0.1037) 44.59%, hsla(0, 0%, 0%, 0.15046) 55.48%, hsla(0, 0%, 0%, 0.2) 65.75%, hsla(0, 0%, 0%, 0.24954) 75.14%, hsla(0, 0%, 0%, 0.2963) 83.41%, hsla(0, 0%, 0%, 0.3375) 90.28%, hsla(0, 0%, 0%, 0.37037) 95.51%, hsla(0, 0%, 0%, 0.39213) 98.83%, hsla(0, 0%, 0%, 0.4));mix-blend-mode:multiply;transition-property:opacity}.jw-state-idle.jwplayer.jw-ab-drop-shadow .jw-controls-backdrop{background-image:linear-gradient(to bottom, hsla(0, 0%, 0%, 0.2), hsla(0, 0%, 0%, 0.19606) 1.17%, hsla(0, 0%, 0%, 0.18519) 4.49%, hsla(0, 0%, 0%, 0.16875) 9.72%, hsla(0, 0%, 0%, 0.14815) 16.59%, hsla(0, 0%, 0%, 0.12477) 24.86%, hsla(0, 0%, 0%, 0.1) 34.25%, hsla(0, 0%, 0%, 0.07523) 44.52%, hsla(0, 0%, 0%, 0.05185) 55.41%, hsla(0, 0%, 0%, 0.03125) 66.66%, hsla(0, 0%, 0%, 0.01481) 78.01%, hsla(0, 0%, 0%, 0.00394) 89.21%, hsla(0, 0%, 0%, 0));background-size:100% 7rem;background-position:50% 0}.jwplayer.jw-ab-drop-shadow.jw-state-idle .jw-controls{background-color:transparent}}.jw-state-idle:not(.jw-flag-cast-available) .jw-display{padding:0}.jw-state-idle .jw-controls{background:rgba(0,0,0,0.4)}.jw-state-idle.jw-flag-cast-available:not(.jw-flag-audio-player) .jw-controlbar .jw-slider-time,.jw-state-idle.jw-flag-cardboard-available .jw-controlbar .jw-slider-time,.jw-state-idle.jw-flag-cast-available:not(.jw-flag-audio-player) .jw-controlbar .jw-icon:not(.jw-icon-cardboard):not(.jw-icon-cast):not(.jw-icon-airplay),.jw-state-idle.jw-flag-cardboard-available .jw-controlbar .jw-icon:not(.jw-icon-cardboard):not(.jw-icon-cast):not(.jw-icon-airplay){display:none}.jwplayer.jw-state-buffering .jw-display-icon-display .jw-icon:focus{border:none}.jwplayer.jw-state-buffering .jw-display-icon-display .jw-icon .jw-svg-icon-buffer{-webkit-animation:jw-spin 2s linear infinite;animation:jw-spin 2s linear infinite;display:block}@-webkit-keyframes jw-spin{100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes jw-spin{100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}.jwplayer.jw-state-buffering .jw-icon-playback .jw-svg-icon-play{display:none}.jwplayer.jw-state-buffering .jw-icon-display .jw-svg-icon-pause{display:none}.jwplayer.jw-state-playing .jw-display .jw-icon-display .jw-svg-icon-play,.jwplayer.jw-state-playing .jw-icon-playback .jw-svg-icon-play{display:none}.jwplayer.jw-state-playing .jw-display .jw-icon-display .jw-svg-icon-pause,.jwplayer.jw-state-playing .jw-icon-playback .jw-svg-icon-pause{display:block}.jwplayer.jw-state-playing.jw-flag-user-inactive:not(.jw-flag-audio-player):not(.jw-flag-casting):not(.jw-flag-media-audio) .jw-controls-backdrop{opacity:0}.jwplayer.jw-state-playing.jw-flag-user-inactive:not(.jw-flag-audio-player):not(.jw-flag-casting):not(.jw-flag-media-audio) .jw-logo-bottom-left,.jwplayer.jw-state-playing.jw-flag-user-inactive:not(.jw-flag-audio-player):not(.jw-flag-casting):not(.jw-flag-media-audio):not(.jw-flag-autostart) .jw-logo-bottom-right{bottom:0}.jwplayer .jw-icon-playback .jw-svg-icon-stop{display:none}.jwplayer.jw-state-paused .jw-svg-icon-pause,.jwplayer.jw-state-idle .jw-svg-icon-pause,.jwplayer.jw-state-error .jw-svg-icon-pause,.jwplayer.jw-state-complete .jw-svg-icon-pause{display:none}.jwplayer.jw-state-error .jw-icon-display .jw-svg-icon-play,.jwplayer.jw-state-complete .jw-icon-display .jw-svg-icon-play,.jwplayer.jw-state-buffering .jw-icon-display .jw-svg-icon-play{display:none}.jwplayer:not(.jw-state-buffering) .jw-svg-icon-buffer{display:none}.jwplayer:not(.jw-state-complete) .jw-svg-icon-replay{display:none}.jwplayer:not(.jw-state-error) .jw-svg-icon-error{display:none}.jwplayer.jw-state-complete .jw-display .jw-icon-display .jw-svg-icon-replay{display:block}.jwplayer.jw-state-complete .jw-display .jw-text{display:none}.jwplayer.jw-state-complete .jw-controls{background:rgba(0,0,0,0.4);height:100%}.jw-state-idle .jw-icon-display .jw-svg-icon-pause,.jwplayer.jw-state-paused .jw-icon-playback .jw-svg-icon-pause,.jwplayer.jw-state-paused .jw-icon-display .jw-svg-icon-pause,.jwplayer.jw-state-complete .jw-icon-playback .jw-svg-icon-pause{display:none}.jw-state-idle .jw-display-icon-rewind,.jwplayer.jw-state-buffering .jw-display-icon-rewind,.jwplayer.jw-state-complete .jw-display-icon-rewind,body .jw-error .jw-display-icon-rewind,body .jwplayer.jw-state-error .jw-display-icon-rewind,.jw-state-idle .jw-display-icon-next,.jwplayer.jw-state-buffering .jw-display-icon-next,.jwplayer.jw-state-complete .jw-display-icon-next,body .jw-error .jw-display-icon-next,body .jwplayer.jw-state-error .jw-display-icon-next{display:none}body .jw-error .jw-icon-display,body .jwplayer.jw-state-error .jw-icon-display{cursor:default}body .jw-error .jw-icon-display .jw-svg-icon-error,body .jwplayer.jw-state-error .jw-icon-display .jw-svg-icon-error{display:block}body .jw-error .jw-icon-container{position:absolute;width:100%;height:100%;top:0;left:0;bottom:0;right:0}body .jwplayer.jw-state-error.jw-flag-audio-player .jw-preview{display:none}body .jwplayer.jw-state-error.jw-flag-audio-player .jw-title{padding-top:4px}body .jwplayer.jw-state-error.jw-flag-audio-player .jw-title-primary{width:auto;display:inline-block;padding-right:.5ch}body .jwplayer.jw-state-error.jw-flag-audio-player .jw-title-secondary{width:auto;display:inline-block;padding-left:0}body .jwplayer.jw-state-error .jw-controlbar,.jwplayer.jw-state-idle:not(.jw-flag-audio-player):not(.jw-flag-cast-available):not(.jw-flag-cardboard-available) .jw-controlbar{display:none}body .jwplayer.jw-state-error .jw-settings-menu,.jwplayer.jw-state-idle:not(.jw-flag-audio-player):not(.jw-flag-cast-available):not(.jw-flag-cardboard-available) .jw-settings-menu{height:100%;top:50%;left:50%;-webkit-transform:translate(-50%, -50%);transform:translate(-50%, -50%)}body .jwplayer.jw-state-error .jw-display,.jwplayer.jw-state-idle:not(.jw-flag-audio-player):not(.jw-flag-cast-available):not(.jw-flag-cardboard-available) .jw-display{padding:0}body .jwplayer.jw-state-error .jw-logo-bottom-left,.jwplayer.jw-state-idle:not(.jw-flag-audio-player):not(.jw-flag-cast-available):not(.jw-flag-cardboard-available) .jw-logo-bottom-left,body .jwplayer.jw-state-error .jw-logo-bottom-right,.jwplayer.jw-state-idle:not(.jw-flag-audio-player):not(.jw-flag-cast-available):not(.jw-flag-cardboard-available) .jw-logo-bottom-right{bottom:0}.jwplayer.jw-state-playing.jw-flag-user-inactive .jw-display{visibility:hidden;pointer-events:none;opacity:0}.jwplayer.jw-state-playing:not(.jw-flag-touch):not(.jw-flag-small-player):not(.jw-flag-casting) .jw-display,.jwplayer.jw-state-paused:not(.jw-flag-touch):not(.jw-flag-small-player):not(.jw-flag-casting):not(.jw-flag-play-rejected) .jw-display{display:none}.jwplayer.jw-state-paused.jw-flag-play-rejected:not(.jw-flag-touch):not(.jw-flag-small-player):not(.jw-flag-casting) .jw-display-icon-rewind,.jwplayer.jw-state-paused.jw-flag-play-rejected:not(.jw-flag-touch):not(.jw-flag-small-player):not(.jw-flag-casting) .jw-display-icon-next{display:none}.jwplayer.jw-state-buffering .jw-display-icon-display .jw-text,.jwplayer.jw-state-complete .jw-display .jw-text{display:none}.jwplayer.jw-flag-casting:not(.jw-flag-audio-player) .jw-cast{display:block}.jwplayer.jw-flag-casting.jw-flag-airplay-casting .jw-display-icon-container{display:none}.jwplayer.jw-flag-casting .jw-icon-hd,.jwplayer.jw-flag-casting .jw-captions,.jwplayer.jw-flag-casting .jw-icon-fullscreen,.jwplayer.jw-flag-casting .jw-icon-audio-tracks{display:none}.jwplayer.jw-flag-casting.jw-flag-airplay-casting .jw-icon-volume{display:none}.jwplayer.jw-flag-casting.jw-flag-airplay-casting .jw-icon-airplay{color:#fff}.jw-state-playing.jw-flag-casting:not(.jw-flag-audio-player) .jw-display,.jw-state-paused.jw-flag-casting:not(.jw-flag-audio-player) .jw-display{display:table}.jwplayer.jw-flag-cast-available .jw-icon-cast,.jwplayer.jw-flag-cast-available .jw-icon-airplay{display:flex}.jwplayer.jw-flag-cardboard-available .jw-icon-cardboard{display:flex}.jwplayer.jw-flag-live .jw-display-icon-rewind{visibility:hidden}.jwplayer.jw-flag-live .jw-controlbar .jw-text-elapsed,.jwplayer.jw-flag-live .jw-controlbar .jw-text-duration,.jwplayer.jw-flag-live .jw-controlbar .jw-text-countdown,.jwplayer.jw-flag-live .jw-controlbar .jw-slider-time{display:none}.jwplayer.jw-flag-live .jw-controlbar .jw-text-alt{display:flex}.jwplayer.jw-flag-live .jw-controlbar .jw-overlay:after{display:none}.jwplayer.jw-flag-live .jw-nextup-container{bottom:44px}.jwplayer.jw-flag-live .jw-text-elapsed,.jwplayer.jw-flag-live .jw-text-duration{display:none}.jwplayer.jw-flag-live .jw-text-live{cursor:default}.jwplayer.jw-flag-live .jw-text-live:hover{color:rgba(255,255,255,0.8)}.jwplayer.jw-flag-live.jw-state-playing .jw-icon-playback .jw-svg-icon-stop,.jwplayer.jw-flag-live.jw-state-buffering .jw-icon-playback .jw-svg-icon-stop{display:block}.jwplayer.jw-flag-live.jw-state-playing .jw-icon-playback .jw-svg-icon-pause,.jwplayer.jw-flag-live.jw-state-buffering .jw-icon-playback .jw-svg-icon-pause{display:none}.jw-text-live{height:24px;width:auto;align-items:center;border-radius:1px;color:rgba(255,255,255,0.8);display:flex;font-size:12px;font-weight:bold;margin-right:10px;padding:0 1ch;text-rendering:geometricPrecision;text-transform:uppercase;transition:150ms cubic-bezier(0, .25, .25, 1);transition-property:box-shadow,color}.jw-text-live::before{height:8px;width:8px;background-color:currentColor;border-radius:50%;margin-right:6px;opacity:1;transition:opacity 150ms cubic-bezier(0, .25, .25, 1)}.jw-text-live.jw-dvr-live{box-shadow:inset 0 0 0 2px currentColor}.jw-text-live.jw-dvr-live::before{opacity:.5}.jw-text-live.jw-dvr-live:hover{color:#fff}.jwplayer.jw-flag-controls-hidden .jw-logo.jw-hide{visibility:hidden;pointer-events:none;opacity:0}.jwplayer.jw-flag-controls-hidden:not(.jw-flag-casting) .jw-logo-top-right{top:0}.jwplayer.jw-flag-controls-hidden .jw-plugin{bottom:.5em}.jwplayer.jw-flag-controls-hidden .jw-nextup-container{bottom:0}.jw-flag-controls-hidden .jw-controlbar,.jw-flag-controls-hidden .jw-display{visibility:hidden;pointer-events:none;opacity:0;transition-delay:0s, 250ms}.jw-flag-controls-hidden .jw-controls-backdrop{opacity:0}.jw-flag-controls-hidden .jw-logo{visibility:visible}.jwplayer.jw-flag-user-inactive:not(.jw-flag-media-audio).jw-state-playing .jw-logo.jw-hide{visibility:hidden;pointer-events:none;opacity:0}.jwplayer.jw-flag-user-inactive:not(.jw-flag-media-audio).jw-state-playing:not(.jw-flag-casting) .jw-logo-top-right{top:0}.jwplayer.jw-flag-user-inactive:not(.jw-flag-media-audio).jw-state-playing .jw-plugin{bottom:.5em}.jwplayer.jw-flag-user-inactive:not(.jw-flag-media-audio).jw-state-playing .jw-nextup-container{bottom:0}.jwplayer.jw-flag-user-inactive:not(.jw-flag-media-audio).jw-state-playing .jw-captions{max-height:none}.jwplayer.jw-flag-user-inactive:not(.jw-flag-media-audio).jw-state-playing video::-webkit-media-text-track-container{max-height:none}.jwplayer.jw-flag-user-inactive:not(.jw-flag-media-audio).jw-state-playing:not(.jw-flag-controls-hidden) .jw-media{cursor:none;-webkit-cursor-visibility:auto-hide}.jwplayer.jw-flag-user-inactive:not(.jw-flag-media-audio).jw-state-playing.jw-flag-casting .jw-display{display:table}.jwplayer.jw-flag-user-inactive:not(.jw-flag-media-audio).jw-state-playing:not(.jw-flag-ads) .jw-autostart-mute{display:flex}.jwplayer.jw-flag-user-inactive:not(.jw-flag-media-audio).jw-flag-casting .jw-nextup-container{bottom:66px}.jwplayer.jw-flag-user-inactive:not(.jw-flag-media-audio).jw-flag-casting.jw-state-idle .jw-nextup-container{display:none}.jw-flag-media-audio .jw-preview{display:block}.jwplayer.jw-flag-ads .jw-preview,.jwplayer.jw-flag-ads .jw-logo,.jwplayer.jw-flag-ads .jw-captions.jw-captions-enabled,.jwplayer.jw-flag-ads .jw-nextup-container,.jwplayer.jw-flag-ads .jw-text-duration,.jwplayer.jw-flag-ads .jw-text-elapsed{display:none}.jwplayer.jw-flag-ads video::-webkit-media-text-track-container{display:none}.jwplayer.jw-flag-ads.jw-flag-small-player .jw-display-icon-rewind,.jwplayer.jw-flag-ads.jw-flag-small-player .jw-display-icon-next,.jwplayer.jw-flag-ads.jw-flag-small-player .jw-display-icon-display{display:none}.jwplayer.jw-flag-ads.jw-flag-small-player.jw-state-buffering .jw-display-icon-display{display:inline-block}.jwplayer.jw-flag-ads .jw-controlbar{flex-wrap:wrap-reverse}.jwplayer.jw-flag-ads .jw-controlbar .jw-slider-time{height:auto;padding:0;pointer-events:none}.jwplayer.jw-flag-ads .jw-controlbar .jw-slider-time .jw-slider-container{height:5px}.jwplayer.jw-flag-ads .jw-controlbar .jw-slider-time .jw-rail,.jwplayer.jw-flag-ads .jw-controlbar .jw-slider-time .jw-knob,.jwplayer.jw-flag-ads .jw-controlbar .jw-slider-time .jw-buffer,.jwplayer.jw-flag-ads .jw-controlbar .jw-slider-time .jw-cue,.jwplayer.jw-flag-ads .jw-controlbar .jw-slider-time .jw-icon-settings{display:none}.jwplayer.jw-flag-ads .jw-controlbar .jw-slider-time .jw-progress{-webkit-transform:none;transform:none;top:auto}.jwplayer.jw-flag-ads .jw-controlbar .jw-tooltip,.jwplayer.jw-flag-ads .jw-controlbar .jw-icon-tooltip:not(.jw-icon-volume),.jwplayer.jw-flag-ads .jw-controlbar .jw-icon-inline:not(.jw-icon-playback):not(.jw-icon-fullscreen):not(.jw-icon-volume){display:none}.jwplayer.jw-flag-ads .jw-controlbar .jw-volume-tip{padding:13px 0}.jwplayer.jw-flag-ads .jw-controlbar .jw-text-alt{display:flex}.jwplayer.jw-flag-ads.jw-flag-ads.jw-state-playing.jw-flag-touch:not(.jw-flag-ads-vpaid) .jw-controls .jw-controlbar,.jwplayer.jw-flag-ads.jw-flag-ads.jw-state-playing.jw-flag-touch:not(.jw-flag-ads-vpaid).jw-flag-autostart .jw-controls .jw-controlbar{display:flex;pointer-events:all;visibility:visible;opacity:1}.jwplayer.jw-flag-ads.jw-flag-ads.jw-state-playing.jw-flag-touch:not(.jw-flag-ads-vpaid).jw-flag-user-inactive .jw-controls-backdrop,.jwplayer.jw-flag-ads.jw-flag-ads.jw-state-playing.jw-flag-touch:not(.jw-flag-ads-vpaid).jw-flag-autostart.jw-flag-user-inactive .jw-controls-backdrop{opacity:1;background-size:100% 60px}.jwplayer.jw-flag-ads-vpaid .jw-display-container,.jwplayer.jw-flag-touch.jw-flag-ads-vpaid .jw-display-container,.jwplayer.jw-flag-ads-vpaid .jw-skip,.jwplayer.jw-flag-touch.jw-flag-ads-vpaid .jw-skip{display:none}.jwplayer.jw-flag-ads-vpaid.jw-flag-small-player .jw-controls{background:none}.jwplayer.jw-flag-ads-vpaid.jw-flag-small-player .jw-controls::after{content:none}.jwplayer.jw-flag-ads-hide-controls .jw-controls-backdrop,.jwplayer.jw-flag-ads-hide-controls .jw-controls{display:none !important}.jw-flag-overlay-open-related .jw-controls,.jw-flag-overlay-open-related .jw-title,.jw-flag-overlay-open-related .jw-logo{display:none}.jwplayer.jw-flag-rightclick-open{overflow:visible}.jwplayer.jw-flag-rightclick-open .jw-rightclick{z-index:16777215}body .jwplayer.jw-flag-flash-blocked .jw-controls,body .jwplayer.jw-flag-flash-blocked .jw-overlays,body .jwplayer.jw-flag-flash-blocked .jw-controls-backdrop,body .jwplayer.jw-flag-flash-blocked .jw-preview{display:none}body .jwplayer.jw-flag-flash-blocked .jw-error-msg{top:25%}.jw-flag-touch.jw-breakpoint-7 .jw-captions,.jw-flag-touch.jw-breakpoint-6 .jw-captions,.jw-flag-touch.jw-breakpoint-5 .jw-captions,.jw-flag-touch.jw-breakpoint-4 .jw-captions,.jw-flag-touch.jw-breakpoint-7 .jw-nextup-container,.jw-flag-touch.jw-breakpoint-6 .jw-nextup-container,.jw-flag-touch.jw-breakpoint-5 .jw-nextup-container,.jw-flag-touch.jw-breakpoint-4 .jw-nextup-container{bottom:4.25em}.jw-flag-touch.jw-breakpoint-7 video::-webkit-media-text-track-container,.jw-flag-touch.jw-breakpoint-6 video::-webkit-media-text-track-container,.jw-flag-touch.jw-breakpoint-5 video::-webkit-media-text-track-container,.jw-flag-touch.jw-breakpoint-4 video::-webkit-media-text-track-container{max-height:calc(100% - 60px)}.jw-flag-touch .jw-controlbar .jw-icon-volume{display:flex}.jw-flag-touch .jw-display,.jw-flag-touch .jw-display-container,.jw-flag-touch .jw-display-controls{pointer-events:none}.jw-flag-touch.jw-state-paused:not(.jw-breakpoint-1) .jw-display-icon-next,.jw-flag-touch.jw-state-playing:not(.jw-breakpoint-1) .jw-display-icon-next,.jw-flag-touch.jw-state-paused:not(.jw-breakpoint-1) .jw-display-icon-rewind,.jw-flag-touch.jw-state-playing:not(.jw-breakpoint-1) .jw-display-icon-rewind{display:none}.jw-flag-touch.jw-state-paused.jw-flag-dragging .jw-display{display:none}.jw-flag-audio-player{background-color:#000}.jw-flag-audio-player:not(.jw-flag-flash-blocked) .jw-media{visibility:hidden}.jw-flag-audio-player .jw-title{background:none}.jw-flag-audio-player object{min-height:44px}.jw-flag-audio-player:not(.jw-flag-live) .jw-spacer{display:none}.jw-flag-audio-player .jw-preview,.jw-flag-audio-player .jw-display,.jw-flag-audio-player .jw-title,.jw-flag-audio-player .jw-nextup-container{display:none}.jw-flag-audio-player .jw-controlbar{position:relative}.jw-flag-audio-player .jw-controlbar .jw-button-container{padding-right:3px;padding-left:0}.jw-flag-audio-player .jw-controlbar .jw-icon-tooltip,.jw-flag-audio-player .jw-controlbar .jw-icon-inline{display:none}.jw-flag-audio-player .jw-controlbar .jw-icon-volume,.jw-flag-audio-player .jw-controlbar .jw-icon-playback,.jw-flag-audio-player .jw-controlbar .jw-icon-next,.jw-flag-audio-player .jw-controlbar .jw-icon-rewind,.jw-flag-audio-player .jw-controlbar .jw-icon-cast,.jw-flag-audio-player .jw-controlbar .jw-text-live,.jw-flag-audio-player .jw-controlbar .jw-icon-airplay,.jw-flag-audio-player .jw-controlbar .jw-logo-button,.jw-flag-audio-player .jw-controlbar .jw-text-elapsed,.jw-flag-audio-player .jw-controlbar .jw-text-duration{display:flex;flex:0 0 auto}.jw-flag-audio-player .jw-controlbar .jw-text-duration,.jw-flag-audio-player .jw-controlbar .jw-text-countdown{padding-right:10px}.jw-flag-audio-player .jw-controlbar .jw-slider-time{flex:0 1 auto;align-items:center;display:flex;order:1}.jw-flag-audio-player .jw-controlbar .jw-icon-volume{margin-right:0;transition:margin-right 150ms cubic-bezier(0, .25, .25, 1)}.jw-flag-audio-player .jw-controlbar .jw-icon-volume .jw-overlay{display:none}.jw-flag-audio-player .jw-controlbar .jw-horizontal-volume-container{transition:width 300ms cubic-bezier(0, .25, .25, 1);width:0}.jw-flag-audio-player .jw-controlbar .jw-horizontal-volume-container.jw-open{width:140px}.jw-flag-audio-player .jw-controlbar .jw-horizontal-volume-container.jw-open .jw-slider-volume{padding-right:24px;transition:opacity 300ms;opacity:1}.jw-flag-audio-player .jw-controlbar .jw-horizontal-volume-container.jw-open~.jw-slider-time{flex:1 1 auto;width:auto;transition:opacity 300ms, width 300ms}.jw-flag-audio-player .jw-controlbar .jw-slider-volume{opacity:0}.jw-flag-audio-player .jw-controlbar .jw-slider-volume .jw-knob{-webkit-transform:translate(-50%, -50%);transform:translate(-50%, -50%)}.jw-flag-audio-player .jw-controlbar .jw-slider-volume~.jw-icon-volume{margin-right:140px}.jw-flag-audio-player.jw-breakpoint-1 .jw-horizontal-volume-container.jw-open~.jw-slider-time,.jw-flag-audio-player.jw-breakpoint-2 .jw-horizontal-volume-container.jw-open~.jw-slider-time{opacity:0}.jw-flag-audio-player.jw-flag-small-player .jw-text-elapsed,.jw-flag-audio-player.jw-flag-small-player .jw-text-duration{display:none}.jw-flag-audio-player.jw-flag-ads .jw-slider-time{display:none}.jw-hidden{display:none}', ""])
    }, function(e, t) {
        e.exports = '<svg class="jw-svg-icon jw-svg-icon-facebook" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 160 160" focusable="false"><path d="M137.8,15H22.1A7.127,7.127,0,0,0,15,22.1V137.8a7.28,7.28,0,0,0,7.1,7.2H84.5V95H67.6V75.5H84.5v-15a23.637,23.637,0,0,1,21.3-25.9,28.08,28.08,0,0,1,4.1-.1c7.2,0,13.7.6,14.9.6V52.7H114.4c-8.5,0-9.7,3.9-9.7,9.7V74.7h19.5l-2.6,19.5H104.7v50.7h33.1a7.3,7.3,0,0,0,7.2-7.2V22A7.13,7.13,0,0,0,137.8,15Z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg class="jw-svg-icon jw-svg-icon-google" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 160 160" focusable="false"><path d="M145.8,67.8H83.1V93.3h36.6a30.5,30.5,0,0,1-13.1,20.2,56.7,56.7,0,0,1-14.4,5.9,58.951,58.951,0,0,1-15.7,0,42.79,42.79,0,0,1-15-6.5,38.861,38.861,0,0,1-15-20.2,42.658,42.658,0,0,1,0-25.5,40.873,40.873,0,0,1,9.8-15.7,38.276,38.276,0,0,1,39.2-9.8,32.516,32.516,0,0,1,14.4,8.5c3.9-3.9,8.5-7.8,12.4-11.8a66.468,66.468,0,0,0,6.5-6.5,73.511,73.511,0,0,0-21.6-13.1,70.341,70.341,0,0,0-45.1-.6A64.526,64.526,0,0,0,24.2,50.9a62.475,62.475,0,0,0,0,58.8,63.293,63.293,0,0,0,18.3,21.5A60.151,60.151,0,0,0,66.7,143a76.5,76.5,0,0,0,34,.7A61.272,61.272,0,0,0,128.1,130a63.793,63.793,0,0,0,17-27.4A99.333,99.333,0,0,0,145.8,67.8Z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg class="jw-svg-icon jw-svg-icon-linkedin" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 160 160" focusable="false"><path d="M135.237,15.006H24.739A9.427,9.427,0,0,0,15,24.107V135.256a9.553,9.553,0,0,0,9.365,9.737h110.9a9.427,9.427,0,0,0,9.737-9.1V24.081A9.461,9.461,0,0,0,135.237,15.006Zm-81.9,110.512H34.476V63.774h19.5v61.744ZM43.576,55.31A10.994,10.994,0,0,1,32.513,44.45v-.2a11.05,11.05,0,0,1,22.1,0A10.537,10.537,0,0,1,44.6,55.283l-.051,0A4.07,4.07,0,0,1,43.576,55.31Zm81.9,70.208h-19.5v-29.9c0-7.164,0-16.265-9.737-16.265s-11.7,7.8-11.7,16.265v29.9h-19.5V63.774h18.2v8.464h0a19.766,19.766,0,0,1,18.2-9.738c19.5,0,23.4,13,23.4,29.266v33.8h.637Z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg class="jw-svg-icon jw-svg-icon-pinterest" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 160 160" focusable="false"><path d="M80,15A65.127,65.127,0,0,0,15,80a66.121,66.121,0,0,0,39,59.8,62.151,62.151,0,0,1,1.3-14.9c1.3-5.2,8.5-35.1,8.5-35.1a26.386,26.386,0,0,1-2-10.4c0-9.7,5.9-16.9,12.4-16.9,5.9,0,8.5,4.5,8.5,9.7a128.456,128.456,0,0,1-5.9,22.7,9.646,9.646,0,0,0,6.6,12,8.105,8.105,0,0,0,3.8.3c12.4,0,20.8-15.6,20.8-34.4,0-14.3-9.7-24.7-27.3-24.7a30.869,30.869,0,0,0-31.8,30v1.2a19.8,19.8,0,0,0,4.5,13,2.586,2.586,0,0,1,.6,3.3c0,1.3-1.3,3.9-1.3,5.2-.6,2-2,2-3.3,2-9.1-3.9-13-13.6-13-24.7,0-18.2,15.6-40.3,46.1-40.3a38.763,38.763,0,0,1,40.9,36.7v.4c0,25.4-14.3,44.9-35.1,44.9A18.163,18.163,0,0,1,72.7,112s-3.9,14.9-4.5,17.6a46.615,46.615,0,0,1-6.5,13.7,79.828,79.828,0,0,0,18.2,1.9A65.1,65.1,0,0,0,80,15Z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg class="jw-svg-icon jw-svg-icon-reddit" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 160 160" focusable="false"><path d="M136.7,60.7a18.265,18.265,0,0,0-11.6,4.1,83.108,83.108,0,0,0-40-11.5l8.1-25.1,21.1,4.7a14.927,14.927,0,1,0,14.9-16.2,15.418,15.418,0,0,0-13.6,8.1L90.5,18.7a3.75,3.75,0,0,0-4.7,2.7h0L77,52.6A93.15,93.15,0,0,0,34.2,64.1,19.471,19.471,0,0,0,23.3,60,19.137,19.137,0,0,0,5,78.3a19.777,19.777,0,0,0,7.5,14.9v4.1a38.88,38.88,0,0,0,20.4,31.9,85.678,85.678,0,0,0,46.8,12.2,93.7,93.7,0,0,0,46.8-12.2,38.741,38.741,0,0,0,20.4-31.9V93.2A18.324,18.324,0,0,0,155,78.3,18.952,18.952,0,0,0,136.7,60.7Zm-7.5-35.3a6.459,6.459,0,0,1,6.8,6v.8a6.744,6.744,0,0,1-6.8,6.8,6.459,6.459,0,0,1-6.8-6v-.8A7.312,7.312,0,0,1,129.2,25.4ZM47.1,89.2A10.2,10.2,0,1,1,57.3,99.4,10.514,10.514,0,0,1,47.1,89.2Zm57,29.8a31.975,31.975,0,0,1-24.4,7.5h0A34.711,34.711,0,0,1,55.3,119a3.821,3.821,0,1,1,5.2-5.6l.2.2a26.476,26.476,0,0,0,19,5.4h0a28.644,28.644,0,0,0,19-5.4,4,4,0,0,1,5.4,0c2,1.3,2,3.4,0,5.4Zm-2-19.7a10.2,10.2,0,1,1,10.2-10.2,10.514,10.514,0,0,1-10.2,10.2Z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg class="jw-svg-icon jw-svg-icon-tumblr" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 160 160" focusable="false"><path d="M115.3,131.6a30.935,30.935,0,0,1-22,7.3h-.7c-28,0-34.6-20.6-34.6-32.7v-34H46.7A2.9,2.9,0,0,1,44,69.5h0V54.2a6.2,6.2,0,0,1,2.7-4,30.359,30.359,0,0,0,20-27.3,3.574,3.574,0,0,1,3-4,1.7,1.7,0,0,1,1,0H87.4a2.9,2.9,0,0,1,2.7,2.7V48.3h19.3a3.18,3.18,0,0,1,2.7,2V69.6a2.9,2.9,0,0,1-2.7,2.7H90v31.3a8.709,8.709,0,0,0,7.4,9.9,5.7,5.7,0,0,0,1.3.1,58.63,58.63,0,0,0,7.3-1.3,4.953,4.953,0,0,1,2.7-.7c.7,0,1.3.7,2,2l5.3,15.3C115.3,129.6,116,130.3,115.3,131.6Z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg class="jw-svg-icon jw-svg-icon-twitter" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 160 160" focusable="false"><path d="M56.8,132.5a75.177,75.177,0,0,0,75.3-75.1V54A53.405,53.405,0,0,0,145,40.5a58.075,58.075,0,0,1-15.4,3.9,27.138,27.138,0,0,0,11.6-14.8A53.038,53.038,0,0,1,124.5,36a25.736,25.736,0,0,0-19.3-8.4A26.12,26.12,0,0,0,78.8,53.4V54a16.5,16.5,0,0,0,.7,5.8,71.966,71.966,0,0,1-54.1-27,23.9,23.9,0,0,0-3.9,13.5A26.043,26.043,0,0,0,33.1,68.2,27.018,27.018,0,0,1,20.9,65v.7A26.15,26.15,0,0,0,42.1,91.4a24.149,24.149,0,0,1-7.1.7,12.625,12.625,0,0,1-5.1-.7,25.657,25.657,0,0,0,24.5,18A53.519,53.519,0,0,1,21.6,121a19.683,19.683,0,0,1-6.4-.7,80.388,80.388,0,0,0,41.6,12.2"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-email" viewBox="0 0 160 160" focusable="false"><path d="M147.3,27.9H11.9L10,29.8v97a3.02,3.02,0,0,0,2.8,3.2H146.6a3.02,3.02,0,0,0,3.2-2.8V31C150.5,29.2,149.2,27.9,147.3,27.9ZM125.6,40.7,80.3,77.1,35,40.7Zm12.1,76.6H22.8V47.7l57.5,46,57.5-46-.1,69.6Z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-link" viewBox="0 0 160 160" focusable="false"><path d="M79.4,99.6H92.5v2a33.6,33.6,0,0,1-9.8,24.2l-9.8,9.8a34.716,34.716,0,0,1-48.4,0,34.716,34.716,0,0,1,0-48.4l9.2-10.5a33.6,33.6,0,0,1,24.2-9.8h1.9V80H58.5a19.359,19.359,0,0,0-15.1,6.5l-9.8,9.8a20.976,20.976,0,0,0-.5,29.6l.5.5a20.976,20.976,0,0,0,29.6.5l.5-.5,9.8-9.8a20.905,20.905,0,0,0,6.5-15h0v-2ZM135,24.4h0a34.716,34.716,0,0,0-48.4,0L76.1,34.2a33.6,33.6,0,0,0-9.8,24.2v2H79.4v-2a19.359,19.359,0,0,1,6.5-15.1l9.8-9.8a20.976,20.976,0,0,1,29.6-.5l.5.5a20.976,20.976,0,0,1,.5,29.6l-.5.5-10.5,9.8a20.905,20.905,0,0,1-15,6.5H99V93h1.3a33.6,33.6,0,0,0,24.2-9.8l9.8-9.8A34.89,34.89,0,0,0,135,24.4ZM63,106.2l42.5-42.5-9.8-9.8L53.2,96.4Z"></path></svg>'
    }, function(e, t) {
        e.exports = '<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-embed" viewBox="0 0 160 160" focusable="false"><path d="M153.224,81.594,126.971,54.685,117.6,64.061l21.846,21.846L117.6,107.752l8.719,8.719L152.567,90.22a5.583,5.583,0,0,0,1.406-7.782,6.067,6.067,0,0,0-.75-.844ZM33.12,54.685,6.868,80.938A5.973,5.973,0,0,0,6.68,89.47l.188.188L33.12,117.128l9.376-9.376-22.5-21.846L42.5,64.061ZM53.747,134.1,94.437,21.5,106.345,25.9,65.654,138.5Z"></path></svg>'
    }, function(e, t, i) {
        var n = i(123);
        "string" == typeof n && (n = [
            ["all-players", n, ""]
        ]), i(41).style(n, "all-players"), n.locals && (e.exports = n.locals)
    }, function(e, t, i) {
        (e.exports = i(64)(!1)).push([e.i, '.jw-settings-content-item .jw-svg-icon{margin-right:1em;height:16px;width:16px;padding:0}.jw-settings-content-item .jw-tooltip{bottom:12px;left:50px;width:60px}.jw-settings-content-item .jw-tooltip.jw-open{transition:none}.jw-sharing-link{display:flex;align-items:center;line-height:16px;text-transform:capitalize}.jw-sharing-link:hover,.jw-sharing-link:focus{text-decoration:none}.jw-sharing-copy:after{background-color:#fff;border-radius:50px;bottom:20px;color:#000;content:"Copied";display:block;font-size:13px;font-weight:bold;opacity:0;margin-left:-25px;left:50%;position:absolute;text-align:center;-webkit-transform:translateY(10px);transform:translateY(10px);transition:all 200ms ease-in-out;visibility:hidden;width:60px}.jw-sharing-copy-textarea-copied:after{opacity:1;-webkit-transform:translateY(0);transform:translateY(0);visibility:visible}.jw-sharing-copy .jw-sharing-link{padding:0}.jw-sharing-copy .jw-sharing-link:hover,.jw-sharing-copy .jw-sharing-link:focus{color:#fff}.jw-sharing-link:focus,.jw-sharing-copy:focus{outline:none}.jw-sharing-link:active,.jw-sharing-copy:active{color:#fff;font-weight:bold}.jw-sharing-textarea{display:flex;opacity:0;height:1px;cursor:pointer}', ""])
    }, function(e, t, i) {
        "use strict";
        var n = i(3),
            o = i(51),
            a = {
                canplay: function() {
                    this.trigger(n.E)
                },
                play: function() {
                    this.stallTime = -1, this.video.paused || this.state === n.qb || this.setState(n.ob)
                },
                loadedmetadata: function() {
                    var e = {
                            metadataType: "media",
                            duration: this.getDuration(),
                            height: this.video.videoHeight,
                            width: this.video.videoWidth,
                            seekRange: this.getSeekRange()
                        },
                        t = this.drmUsed;
                    t && (e.drm = t), this.trigger(n.K, e)
                },
                timeupdate: function() {
                    var e = this.video.currentTime,
                        t = this.getCurrentTime(),
                        i = this.getDuration();
                    if (!isNaN(i)) {
                        this.seeking || this.video.paused || this.state !== n.rb && this.state !== n.ob || this.stallTime === e || (this.stallTime = -1, this.setState(n.qb), this.trigger(n.gb));
                        var o = {
                            position: t,
                            duration: i,
                            currentTime: e,
                            seekRange: this.getSeekRange(),
                            metadata: {
                                currentTime: e
                            }
                        };
                        if (this.getPtsOffset) {
                            var a = this.getPtsOffset();
                            a >= 0 && (o.metadata.mpegts = a + t)
                        }(this.state === n.qb || this.seeking) && this.trigger(n.S, o)
                    }
                },
                click: function(e) {
                    this.trigger(n.n, e)
                },
                volumechange: function() {
                    var e = this.video;
                    this.trigger(n.V, {
                        volume: Math.round(100 * e.volume)
                    }), this.trigger(n.M, {
                        mute: e.muted
                    })
                },
                seeked: function() {
                    this.seeking && (this.seeking = !1, this.trigger(n.R))
                },
                playing: function() {
                    -1 === this.stallTime && this.setState(n.qb), this.trigger(n.gb)
                },
                pause: function() {
                    this.state !== n.lb && (this.video.ended || this.video.error || this.video.currentTime !== this.video.duration && this.setState(n.pb))
                },
                progress: function() {
                    var e = this.getDuration();
                    if (!(e <= 0 || e === 1 / 0)) {
                        var t = this.video.buffered;
                        if (t && 0 !== t.length) {
                            var i = Object(o.a)(t.end(t.length - 1) / e, 0, 1);
                            this.trigger(n.D, {
                                bufferPercent: 100 * i,
                                position: this.getCurrentTime(),
                                duration: e,
                                currentTime: this.video.currentTime,
                                seekRange: this.getSeekRange()
                            })
                        }
                    }
                },
                ratechange: function() {
                    this.trigger(n.P, {
                        playbackRate: this.video.playbackRate
                    })
                },
                ended: function() {
                    this.videoHeight = 0, this.streamBitrate = 0, this.state !== n.nb && this.state !== n.lb && this.trigger(n.F)
                },
                loadeddata: function() {
                    this.renderNatively && this.setTextTracks(this.video.textTracks)
                }
            };
        t.a = a
    }, function(e, t, i) {
        "use strict";
        var n = i(6),
            o = i(23),
            a = i(78),
            r = {
                container: null,
                volume: function(e) {
                    this.video.volume = Math.min(Math.max(0, e / 100), 1)
                },
                mute: function(e) {
                    this.video.muted = !!e, this.video.muted || this.video.removeAttribute("muted")
                },
                resize: function(e, t, i) {
                    var a = this.video,
                        r = a.videoWidth,
                        s = a.videoHeight;
                    if (e && t && r && s) {
                        var l = {
                            objectFit: "",
                            width: "",
                            height: ""
                        };
                        if ("uniform" === i) {
                            var c = e / t,
                                u = r / s,
                                d = Math.abs(c - u);
                            d < .09 && d > .0025 && (l.objectFit = "fill", i = "exactfit")
                        }
                        if (n.Browser.ie || n.OS.iOS && n.OS.version.major < 9 || n.Browser.androidNative)
                            if ("uniform" !== i) {
                                l.objectFit = "contain";
                                var p = e / t,
                                    f = r / s,
                                    h = 1,
                                    w = 1;
                                "none" === i ? h = w = p > f ? Math.ceil(100 * s / t) / 100 : Math.ceil(100 * r / e) / 100 : "fill" === i ? h = w = p > f ? p / f : f / p : "exactfit" === i && (p > f ? (h = p / f, w = 1) : (h = 1, w = f / p)), Object(o.e)(a, "matrix(".concat(h.toFixed(2), ", 0, 0, ").concat(w.toFixed(2), ", 0, 0)"))
                            } else l.top = l.left = l.margin = "", Object(o.e)(a, "");
                        Object(o.d)(a, l)
                    }
                },
                getContainer: function() {
                    return this.container
                },
                setContainer: function(e) {
                    this.container = e, this.video.parentNode !== e && e.appendChild(this.video)
                },
                remove: function() {
                    this.stop(), this.destroy();
                    var e = this.container;
                    e && e === this.video.parentNode && e.removeChild(this.video)
                },
                atEdgeOfLiveStream: function() {
                    if (!this.isLive()) return !1;
                    return Object(a.a)(this.video.buffered) - this.video.currentTime <= 2
                }
            };
        t.a = r
    }, function(e, t, i) {
        "use strict";
        t.a = {
            attachMedia: function() {
                this.eventsOn_()
            },
            detachMedia: function() {
                return this.eventsOff_(), this.video
            }
        }
    }, function(e, t, i) {
        "use strict";
        i.d(t, "b", function() {
            return o
        }), i.d(t, "a", function() {
            return a
        });
        var n = i(1);

        function o(e, t, i) {
            var o = e + 1e3,
                r = n.o;
            return t > 0 ? (403 === t && (r = n.q), o += a(t)) : "http:" === ("" + i).substring(0, 5) && "https:" === document.location.protocol ? o += 12 : 0 === t && (o += 11), {
                code: o,
                key: r
            }
        }
        var a = function(e) {
            return e >= 400 && e < 600 ? e : 6
        }
    }])
]);
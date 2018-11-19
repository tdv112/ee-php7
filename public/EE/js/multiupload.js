/**
 * HTML5 Pure Uploader 3.0
 * http://www.tqera.com/
 *
 * Copyright 2014, Lyzerk
 *
 * Date: 30-01-2015
 * License : http://codecanyon.net/item/pure-uploader/4452882
 */
 

function printLog(n) {
    console.log("------Log Report------");
    console.log(new Date);
    console.log(n);
    console.log("------##########------")
}

function printError(n) {
    typeof n == "object" ? (n.message && (console.log("------Error Message------"), console.log("\nMessage: " + n.message)), n.stack && console.log(n.stack), console.log("------#############------")) : console.log("printError :: argument is not an object")
}

function contains(n, t) {
    for (var i in t)
        if (n.match(t[i])) return !0;
    return !1
}

function getFileExtension(n) {
    var t = n.split(".");
    return t.length === 1 || t[0] === "" && t.length === 2 ? "" : t.pop().toLowerCase()
}

function endsWith(n, t) {
    return n.indexOf(t, n.length - t.length) !== -1
}

function humanFileSize(n, t) {
    var i = t ? 1e3 : 1024,
        u, r;
    if (n < i) return n + " B";
    u = t ? ["KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"] : ["KiB", "MiB", "GiB", "TiB", "PiB", "EiB", "ZiB", "YiB"];
    r = -1;
    do n /= i, ++r; while (n >= i);
    return n.toFixed(1) + " " + u[r]
}

function extend() {
    var f, u, i, t, e, o, n = arguments[0] || {},
        r = 1,
        h = arguments.length,
        s = !1;
    for (typeof n == "boolean" && (s = n, n = arguments[1] || {}, r = 2), typeof n == "object" || jQuery.isFunction(n) || (n = {}), h === r && (n = this, --r); r < h; r++)
        if ((f = arguments[r]) != null)
            for (u in f)(i = n[u], t = f[u], n !== t) && (s && t && (jQuery.isPlainObject(t) || (e = jQuery.isArray(t))) ? (e ? (e = !1, o = i && jQuery.isArray(i) ? i : []) : o = i && jQuery.isPlainObject(i) ? i : {}, n[u] = jQuery.extend(s, o, t)) : t !== undefined && (n[u] = t));
    return n
}

function b64toBlob(n, t, i) {
    var e, o, r, f, s, u, h;
    for (t = t || "", i = i || 512, e = atob(n), o = [], r = 0; r < e.length; r += i) {
        for (f = e.slice(r, r + i), s = new Array(f.length), u = 0; u < f.length; u++) s[u] = f.charCodeAt(u);
        h = new Uint8Array(s);
        o.push(h)
    }
    return new Blob(o, {
        type: t
    })
}

function isFunction(n) {
    return n && {}.toString.call(n) === "[object Function]"
}

var defaultSettings = {
        name: "uploader",
        drop: !0,
        dropPlace: document.getElementById("dropPlace"),
        dragHoverClass: "hover",
        imageHolder: document.getElementById("imageHolder"),
        file_input: document.getElementById("fileInput"),
        file_filter: "image|text",
        file_size: 1048576e3,
        file_class: "file",
        template: '<div class="form-group text-center"><a href="javascript:void(0)" class="btn btn-danger close" onclick="{uploader}.remove(\'{id}\')">x<\/a>{image}<\/div><div class="form-group text-center"><div class="form-group col-md-6"><a href="javascript:void(0)" class="btn btn-info" onclick="{uploader}.start(\'{id}\')">Start<\/a><\/div><div class="form-group col-md-6"><a href="javascript:void(0)" class="btn btn-info" onclick="{uploader}.pause(\'{id}\')">Pause<\/a><\/div><p>{file.name} - {file.size}<\/p><\/div>',
        limit: 0,
        ajax: {
            url: "",
            clearAfterUpload: !0,
            beforeSend: function() {}
        },
        form: document.getElementById("imageForm"),
        image: {
            thumb: !0,
            thumb_width: 200,
            thumb_height: 200,
            resize_width: 0,
            resize_height: 0,
            keep_aspect_ratio: !1,
            preparing: "preparing.png"
        },
        watermark: {
            watermark: !0,
            image: "",
            image_aspect_ratio: !1,
            text: "www.nhadat.net",
            color: "#E65711",
            alpha: 1,
            font_size: "55px",
            font: "bold sans-serif",
            position: "mid center"
        },
        icon: {
            icon: !0,
            path: "/images/icons",
            _default: "/images/icons/_blank.png",
            width: 128,
            height: 128,
            extension: ".png"
        },
        auto_upload: !1,
        debug: !1,
        chunk: {
            active: !1,
            size: 1048576
        },
        errors: {
            INIT_DROP: "Drop Place can not initialize",
            INIT_IMG_HOLDER: "Image Holder can not initialize",
            INIT_IMG_THUMB: "Image Properties (thumb, width, height) can not initialize",
            INIT_FILE_INPUT: "File Input can not initialize",
            INIT_FILE_FILTER: "File Filter can not initialize",
            INIT_FILE_SIZE: "File Size can not initialize",
            INIT_FILE_FORM: "File Form can not initialize",
            INIT_TEMPLATE: "Your template content has not exist {image} tag",
            INIT_WATERMARK_IMAGE: "Watermark image can not initialize, watermark text will be on",
            THUMB_SIZE: "Thumbnail must be higher than 10x10",
            THUMB_PROCESS: "Something weird happened in thumbnail process",
            FILE_SIZE_INT: "File size must be integer",
            UPLOAD_LIMIT: "Upload limit is {limit}",
            FILE_SIZE_LARGER: "File size too larger",
            FILE_DOESNT_SUPPORT: "File does not support",
            TEMPLATE_CREATE: "Something weird happened in create of template, please check for details.",
            NETWORK: "Network error, please check for details.",
            FIND_ITEM: "There is no item for this id : {id}"
        },
        html5Error: function() {
            printLog("No HTML5 support")
        },
        success: function(rs) {
            return rs;
        },
        progress: function(n) {
            printLog("Picture " + n)
        },
        error: function() {}
    },
    isLocalStorage = function() {
        try {
            return localStorage.setItem(mod, mod), localStorage.removeItem(mod), !0
        } catch (n) {
            return !1
        }
    },
    isCanvas = function() {
        var n = document.createElement("canvas");
        return !!(n.getContext && n.getContext("2d"))
    },
    isCanvasText = function() {
        return !!(isCanvas() && is(document.createElement("canvas").getContext("2d").fillText, "function"))
    },
    isHTML5 = function() {
        return isCanvasText && isLocalStorage && window.File && window.FileReader && window.FileList && window.Blob && window.FormData
    };

function PureUploader(n) {
    function b(n) {
        n.watermark.image && (u.src = t.watermark.image, u.onerror = function() {
            printLog(n.errors.INIT_WATERMARK_IMAGE);
            n.watermark.image = ""
        })
    }

    function k(n) {
        return n.drop ? n.dropPlace ? (n.dropPlace.ondragover = function() {
            return this.className.match(n.dragHoverClass) || (this.className += " " + n.dragHoverClass), !1
        }, n.dropPlace.ondragleave = function() {
            return this.className.match(n.dragHoverClass) && (this.className = this.className.replace(n.dragHoverClass, "")), !1
        }, n.dropPlace.ondrop = function(n) {
            return this.className.match(t.dragHoverClass) && (this.className = this.className.replace(t.dragHoverClass, "")), v(n.dataTransfer.files), !1
        }, !0) : !1 : !0
    }

    function d(n) {
        return n.imageHolder ? !0 : !1
    }

    function g(n) {
        return n.file_input && n.file_input.tagName == "INPUT" && n.file_input.type == "file" ? (n.file_input.addEventListener("change", et, !1), !0) : !1
    }

    function nt(n) {
        if (n.file_filter || n.file_filter != " ") {
            var t = n.file_filter.split("|");
            return t.length < 1 ? !1 : (a = t, !0)
        }
        return !1
    }

    function tt(n) {
        return n.image.thumb ? n.image.thumb_width && n.image.thumb_height ? n.image.thumb_width > 10 && n.image.thumb_height > 10 ? !0 : (t.error(r, n.errors.THUMB_SIZE), !1) : !1 : !0
    }

    function it(n) {
        return parseInt(n.file_size) ? !0 : (t.error(r, n.errors.FILE_SIZE_INT), !1)
    }

    function rt(n) {
        return n.form ? !0 : !1
    }

    function ut(n) {
        return (n.image.thumb || n.icon.icon) && !n.template.match(/{image}/g) ? !1 : !0
    }

    function ft(n, i, u) {
        var e, f;
        try {
            e = document.createElement("div");
            e.id = n;
            e.className = t.file_class;
            e.appendChild(o);
            f = t.template.replace(/{id}/g, n);
            f = f.replace(/{uploader}/g, t.name);
            f = t.image.thumb || t.icon.icon ? f.replace("{image}", "<img src='" + t.image.preparing + "' id=img_" + n + " />") : f.replace("{image}", "");
            f = f.replace("{file.name}", i);
            f = f.replace("{file.size}", u);
            e.innerHTML += f;
            t.imageHolder.appendChild(e);
            t.imageHolder.appendChild(o)
        } catch (s) {
            t.error(r, t.errors.TEMPLATE_CREATE, s)
        }
    }

    function v(n) {
        var u, e;
        for (u in n) typeof n[u] == "object" && (contains(getFileExtension(n[u].name), a) ? n[u].size < t.file_size ? t.limit == 0 ? s.push(n[u]) : i.length <= t.limit ? s.push(n[u]) : (e = t.errors.UPLOAD_LIMIT.replace(/{limit}/g, t.limit), t.error(r, e)) : t.error(r, t.errors.FILE_SIZE_LARGER) : t.error(r, t.errors.FILE_DOESNT_SUPPORT));
        f()
    }

    function et(n) {
        v(n.target.files);
        t.file_input.value = ""
    }

    function f() {
        var n, f, u;
        if (t.auto_upload && h(null), n = s.shift(), n != null) {
            if (t.limit != 0 && i.length + 1 > t.limit) return f = t.errors.UPLOAD_LIMIT.replace(/{limit}/g, t.limit), t.error(r, f), !1;
            u = "11111temp_" + (new Date).getTime();
            ft(u, n.name, humanFileSize(n.size, !0));
            ot(u, n)
        }
    }

    function ot(n, i) {
        t.chunk.active ? ct(n, i) : st(n, i)
    }

    function st(n, e) {
        var s = new FileReader,
            o = document.getElementById(n);
        s.onload = function(s) {
            var v, c;
            if (s.preventDefault(), isCanvasText && e.type.match("image") && !e.type.match("gif")) {
                var a = document.createElement("canvas"),
                    p = a.getContext("2d"),
                    l = document.createElement("canvas"),
                    y = l.getContext("2d"),
                    c = new Image;
                c.onload = function() {
                    var d = 1,
                        g, nt, n, v, k, b, s, w, rt;
                    if (g = t.image.resize_width && t.image.resize_width != 0 ? t.image.resize_width : c.width, nt = !t.image.keep_aspect_ratio && t.image.resize_height && t.image.resize_height != 0 ? t.image.resize_height : t.image.keep_aspect_ratio && t.image.resize_width && t.image.resize_width != 0 ? t.image.resize_width / (c.width / c.height) : c.height, c.width > t.image.thumb_width ? d = t.image.thumb_width / c.width : c.height > t.image.thumb_height && (d = t.image.thumb_height / c.height), l.width = g, l.height = nt, y.drawImage(c, 0, 0, l.width, l.height), t.watermark.watermark) {
                        if (n = document.createElement("canvas"), v = n.getContext("2d"), n.width = g, n.height = nt, t.watermark.image) k = u.width, b = u.height, t.watermark.image_aspect_ratio && (k = u.width, b = u.height / (g / nt)), s = 0, w = b, t.watermark.position.match("bottom") ? w = n.height - b : t.watermark.position.match("top") ? w = 0 : t.watermark.position.match("center") && (w = (n.height - b) / 2), t.watermark.position.match("left") ? s = 0 : t.watermark.position.match("mid") ? s = (n.width - k) / 2 : t.watermark.position.match("right") && (s = n.width - k), v.globalAlpha = t.watermark.alpha, v.drawImage(u, s, w, k, b);
                        else if (t.watermark.text) {
                            v.fillStyle = t.watermark.color;
                            v.font = t.watermark.font_size + " " + t.watermark.font;
                            v.globalAlpha = t.watermark.alpha;
                            var it = v.measureText(t.watermark.text),
                                tt = t.watermark.font_size.match("px") ? t.watermark.font_size.replace("px", "") : t.watermark.font_size,
                                s = 0,
                                w = tt;
                            t.watermark.position.match("bottom") ? w = n.height - tt * .3 : t.watermark.position.match("top") ? s = 0 + tt * .3 : t.watermark.position.match("center") && (w = (n.height - tt) / 2);
                            t.watermark.position.match("left") ? s = 0 : t.watermark.position.match("mid") ? s = (n.width - it.width) / 2 : t.watermark.position.match("right") && (s = n.width - it.width);
                            v.translate(s, w);
                            v.fillText(t.watermark.text, 0, 0)
                        }
                        y.drawImage(n, 0, 0, n.width, n.height, 0, 0, n.width, n.height)
                    }
                    if (a.width = c.width * d, a.height = c.height * d, p.drawImage(l, 0, 0, l.width, l.height, 0, 0, a.width, a.height), i.push({
                            data: l.toDataURL(e.type),
                            name: e.name,
                            id: o.id,
                            state: "ready"
                        }), t.image.thumb) try {
                        a.style.cursor = "pointer";
                        a.onclick = function() {
                            var n = window.open(l.toDataURL(e.type), "_blank");
                            n.focus()
                        };
                        rt = document.getElementById("img_" + o.id);
                        rt.src = a.toDataURL(e.type)
                    } catch (ut) {
                        t.error(r, t.errors.THUMB_PROCESS, ut)
                    }
                    f();
                    t.auto_upload && h(null);
                    delete l;
                    delete y
                };
                c.src = this.result
            } else t.image.thumb && e.type.match("gif") ? (c = document.getElementById("img_" + o.id), c.width = t.image.thumb_width, c.height = t.image.thumb_height, c.src = this.result, i.push({
                data: this.result,
                name: e.name,
                id: o.id,
                chunk: !1,
                state: "ready"
            }), f()) : (t.icon.icon && (v = getFileExtension(e.name), v = (endsWith(t.icon.path, "/") ? "" : "/") + v, c = document.getElementById("img_" + n), c.width = t.icon.width, c.height = t.icon.height, c.onerror = function() {
                c.src = location.protocol + "/" + location.host + t.icon._default;
                c.onerror = undefined
            }, c.src = location.protocol + "/" + location.host + t.icon.path + v + t.icon.extension), i.push({
                data: this.result,
                name: e.name,
                id: o.id,
                chunk: !1,
                state: "ready"
            }), f())
        };
        s.readAsDataURL(e)
    }

    function ht(n, e, o) {
        var a, s;
        if (o.type.match("gif")) a = document.getElementById(n), s = document.getElementById("img_" + n), s.width = t.image.thumb_width, s.height = t.image.thumb_height, s.src = e, i.push({
            data: e,
            name: o.name,
            id: n,
            chunk: !1,
            state: "ready"
        }), f();
        else {
            var c = document.createElement("canvas"),
                v = c.getContext("2d"),
                h = document.createElement("canvas"),
                l = h.getContext("2d"),
                s = new Image;
            s.onload = function() {
                var d = 1,
                    g, nt, e, y, k, w, a, p, b;
                if (g = t.image.resize_width && t.image.resize_width != 0 ? t.image.resize_width : s.width, nt = !t.image.keep_aspect_ratio && t.image.resize_height && t.image.resize_height != 0 ? t.image.resize_height : t.image.keep_aspect_ratio && t.image.resize_width && t.image.resize_width != 0 ? t.image.resize_width / (s.width / s.height) : s.height, s.width > t.image.thumb_width ? d = t.image.thumb_width / s.width : s.height > t.image.thumb_height && (d = t.image.thumb_height / s.height), h.width = g, h.height = nt, l.drawImage(s, 0, 0, h.width, h.height), t.watermark.watermark) {
                    if (e = document.createElement("canvas"), y = e.getContext("2d"), e.width = g, e.height = nt, t.watermark.image) k = u.width, w = u.height, t.watermark.image_aspect_ratio && (k = u.width, w = u.height / (g / nt)), a = 0, p = w, t.watermark.position.match("bottom") ? p = e.height - w : t.watermark.position.match("top") ? p = 0 : t.watermark.position.match("center") && (p = (e.height - w) / 2), t.watermark.position.match("left") ? a = 0 : t.watermark.position.match("mid") ? a = (e.width - k) / 2 : t.watermark.position.match("right") && (a = e.width - k), y.globalAlpha = t.watermark.alpha, y.drawImage(u, a, p, k, w);
                    else if (t.watermark.text) {
                        y.fillStyle = t.watermark.color;
                        y.font = t.watermark.font_size + " " + t.watermark.font;
                        y.globalAlpha = t.watermark.alpha;
                        var it = y.measureText(t.watermark.text),
                            tt = t.watermark.font_size.match("px") ? t.watermark.font_size.replace("px", "") : t.watermark.font_size,
                            a = 0,
                            p = tt;
                        t.watermark.position.match("bottom") ? p = e.height - tt * .3 : t.watermark.position.match("top") ? a = 0 + tt * .3 : t.watermark.position.match("center") && (p = (e.height - tt) / 2);
                        t.watermark.position.match("left") ? a = 0 : t.watermark.position.match("mid") ? a = (e.width - it.width) / 2 : t.watermark.position.match("right") && (a = e.width - it.width);
                        y.translate(a, p);
                        y.fillText(t.watermark.text, 0, 0)
                    }
                    l.drawImage(e, 0, 0, e.width, e.height, 0, 0, e.width, e.height)
                }
                if (c.width = s.width * d, c.height = s.height * d, v.drawImage(h, 0, 0, h.width, h.height, 0, 0, c.width, c.height), t.image.thumb) {
                    b = document.getElementById("img_" + n);
                    b.width = c.width;
                    b.height = c.height;
                    b.src = c.toDataURL(o.type);
                    try {
                        b.style.cursor = "pointer";
                        b.onclick = function() {
                            var n = window.open(h.toDataURL(o.type), "_blank");
                            n.focus()
                        }
                    } catch (rt) {
                        t.error(r, t.errors.THUMB_PROCESS, rt)
                    }
                }
                var ut = h.toDataURL(o.type),
                    ft = ut.split(","),
                    et = b64toBlob(ft[1], o.type);
                i.push({
                    data: new File([et], o.name),
                    type: "image",
                    id: n,
                    chunk: !0,
                    lastPosition: 0,
                    state: "ready"
                });
                f();
                delete h;
                delete l
            };
            s.src = e
        }
    }

    function ct(n, r) {
        var o, e, u;
        t.image.thumb && r.type.match("image") ? (o = new FileReader, o.onload = function() {
            ht(n, this.result, r)
        }, o.readAsDataURL(r)) : (i.push({
            data: r,
            type: "normal",
            id: n,
            chunk: !0,
            lastPosition: 0,
            state: "ready"
        }), t.icon.icon && (e = getFileExtension(r.name), e = (endsWith(t.icon.path, "/") ? "" : "/") + e, u = document.getElementById("img_" + n), u.width = t.icon.width, u.height = t.icon.height, u.onerror = function() {
            u.src = location.protocol + "/" + location.host + t.icon._default;
            u.onerror = undefined
        }, u.src = location.protocol + "/" + location.host + t.icon.path + e + t.icon.extension));
        f()
    }

    function e(n) {
        var r, u;
        if (typeof n == "object") e(n.currentTarget.parentNode.id);
        else
            for (r in i) i[r].id == n && (i.splice(r, 1), u = document.getElementById(n), t.imageHolder.removeChild(u))
    }

    function h(n) {
        n && n.preventDefault();
        for (var t in i) i[t].state == "ready" && (i[t].state = "uploading", y(i[t]));
        return !1
    }

    function y(n) {
        n.chunk ? p(n) : lt(n)
    }

    function lt(n) {
        var i = new XMLHttpRequest;
        i.open("POST", t.ajax.url, !0);
        i.setRequestHeader("UploaderName", t.name);
        i.setRequestHeader("FileName", n.name);
        i.setRequestHeader("FileSize", n.data.length);
        i.setRequestHeader("Chunk", !1);
        i.onerror = w;
        i.upload.template_id = n.id;
        t.ajax.beforeSend && t.ajax.beforeSend(i);
        i.setRequestHeader("Content-type", n.data.split(",")[0]);
        i.onreadystatechange = l;
        i.upload.addEventListener("load", l, !1);
        i.upload.addEventListener("progress", c, !1);
        n.xhr = i;
        i.send(n.data)
    }

    function p(n) {
        var i = new XMLHttpRequest;
        i.open("POST", t.ajax.url, !0);
        i.onerror = w;
        i.upload.template_id = n.id;
        t.ajax.beforeSend && t.ajax.beforeSend(i);
        i.setRequestHeader("UploaderName", t.name);
        i.setRequestHeader("FileTemplateId", n.id);
        i.setRequestHeader("FileName", n.data.name);
        i.setRequestHeader("FileSize", n.data.size);
        i.setRequestHeader("Chunk", !0);
        i.setRequestHeader("ChunkSize", t.chunk.size);
        i.setRequestHeader("ChunkPosition", n.lastPosition);
        var u = n.data,
            r = n.lastPosition,
            f = u.slice(r, r + t.chunk.size);
        n.lastPosition = r + t.chunk.size;
        i.onreadystatechange = l;
        n.xhr = i;
        i.send(f)
    }

    function w(n) {
        t.error(r, t.errors.NETWORK, n)
    }

    function c(n) {
        if (t.progress) {
            var i = n.totalSize * 100 / n.position;
            t.progress({
                percent: i,
                template: n.target.template_id
            })
        }
    }

    function l(n) {
        var i = n.target.template_id,
            u, f, o, s;
        i || (i = n.target.upload.template_id);
        u = r.find(i);
        u != null ? u.chunk ? n.target.readyState == 4 && n.target.status == 200 && (f = u.data.size, o = u.lastPosition, u.lastPosition > f ? (c({
            totalSize: f,
            position: f,
            target: {
                template_id: i
            }
        }), t.ajax.clearAfterUpload && setTimeout(e, 1500, i), t.success && t.success(n)) : (c({
            totalSize: o,
            position: f,
            target: {
                template_id: i
            }
        }), u.state == "uploading" && n.totalSize == n.total && p(u))) : n.target.readyState == 4 && (n.target.status == 200 ? (t.ajax.clearAfterUpload && setTimeout(e, 1500, i), t.success && (t.progress({
            percent: 100,
            template: i
        }), t.success(n))) : t.error(r, t.errors.NETWORK, n)) : (s = t.errors.FIND_ITEM.replace(/{id}/g, i), t.error(r, s))
    }
    var u;
    n = extend(!1, defaultSettings, n);
    var a, t = n,
        o = document.createElement("div"),
        s = [],
        i = [],
        r = this;
    if (this.settings = t, !isHTML5()) {
        n.html5Error(this);
        return
    }
    if (u = new Image, o.style.clear = "both", !k(t)) return printLog(t.errors.INIT_DROP) && !1;
    if (!d(t)) return printLog(t.errors.INIT_IMG_HOLDER) && !1;
    if (!tt(t)) return printLog(t.errors.INIT_IMG_THUMB) && !1;
    if (!g(t)) return printLog(t.errors.INIT_FILE_INPUT) && !1;
    if (!nt(t)) return printLog(t.errors.INIT_FILE_FILTER) && !1;
    if (!it(t)) return printLog(t.errors.INIT_FILE_SIZE) && !1;
    if (!rt(t)) return printLog(t.errors.INIT_FILE_FORM) && !1;
    if (!ut(t)) return printLog(t.errors.INIT_TEMPLATE) && !1;
    b(t);
    t.dropPlace.onclick = function() {
        t.file_input.click()
    };
    t.form.addEventListener("submit", h, !1);
    this.find = function(n) {
        var r = null,
            t;
        for (t in i)
            if (i[t].id == n) {
                r = i[t];
                break
            }
        return r
    };
    this.start = function(n, t) {
        var i = this.find(n);
        i && (i.state == "ready" || i.state == "paused") && (i.state = "uploading", y(i));
        isFunction(t) && t()
    };
    this.pause = function(n, t) {
        var i = this.find(n);
        i && i.state == "uploading" && (i.state = "paused");
        isFunction(t) && t()
    };
    this.remove = function(n, t) {
        var i = this.find(n);
        i && (i.xhr && i.xhr.abort && i.xhr.abort(), i.chunk ? i.state == "uploading" ? i.state = "removed" : e(n) : e(n));
        isFunction(t) && t()
    };
    this.isworking = function() {
        var t = !1,
            n;
        for (n in i)
            if (i[n].state == "uploading" || i[n].state == "paused") {
                t = !0;
                break
            }
        return t
    }
};
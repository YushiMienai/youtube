<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="row justify-content-center" id="youtubelist">

</div>
<style>
    .boxie {
        position: relative;
        margin: 20px;;
        max-width:480px;
    }
    .boxie .ratio16-9 {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        cursor:pointer;
    }
    .boxie:before {
        content: "";
        display: block;
        padding-top: 56.25%;
    }

    .title-footer {
        bottom: 0;
        position: absolute;
        background-color: #808080 !important;
        color: #fff;
        opacity: 0.7;
        -moz-opacity: 0.7;
        width: 100%; }
</style>
<script>

    let getJSON = function(url, callback) {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);
        xhr.responseType = 'json';
        xhr.onload = function() {
            let status = xhr.status;
            if (status === 200) {
                callback(null, xhr.response);
            } else {
                callback(status, xhr.response);
            }
        };
        xhr.send();
    };

    document.addEventListener('DOMContentLoaded', function(){
        let strGET = window
            .location
            .search
            .replace('?','')
            .split('&')
            .reduce(
                function(p,e){
                    var a = e.split('=');
                    p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
                    return p;
                },
                {}
            );
        let str = strGET['id'];

        str = str.replace(/[^a-zA-Z0-9-_,]/,'');

        let youtubediv = document.getElementById("youtubelist");
        let ids = str.split(",");

        for (let i = 0; i < ids.length; i++){
            if (ids[i].length != 11) continue;
            getJSON('http://noembed.com/embed?url=http://www.youtube.com/embed/' + ids[i],
                function(err, data) {
                    if (data.error == undefined) {

                        let card = document.createElement('div');
                        card.className = 'card boxie text-center col-12 col-lg-4 col-xl-4';
                        card.style.backgroundImage  = 'url('+data.thumbnail_url+')';
                        card.style.backgroundPosition = 'center';

                        let ratio = document.createElement('div');
                        ratio.className = 'ratio16-9';

                        ratio.onclick = function() {
                            let iframes = document.getElementsByTagName('iframe');
                            let titlefooter = document.getElementsByClassName('title-footer');

                            console.log(this);

                            let video = this.getElementsByTagName('iframe')[0],
                                footer = this.getElementsByClassName('title-footer')[0],
                                src = video.getAttribute('data-src');
                            for(let j = 0; j < iframes.length; j++){
                                iframes[j].style.display = 'none';
                                iframes[j].setAttribute('src','');
                                titlefooter[j].style.display = 'block';
                            }
                            footer.style.display = 'none';
                            video.style.display = 'block';
                            video.setAttribute('src', '//www.youtube.com/embed/'+ src + '?autoplay=1');
                        };

                        let titleFooter = document.createElement('div');
                        titleFooter.className = 'title-footer';
                        titleFooter.innerHTML = data.title;

                        let iframe = document.createElement('iframe');
                        iframe.style.width = '100%';
                        iframe.style.height = '100%';
                        iframe.style.display = 'none';
                        iframe.src = ids[i];
                        iframe.setAttribute('data-src', ids[i]);
                        iframe.setAttribute('frameborder', "0");
                        iframe.setAttribute('allowfullscreen','');

                        ratio.appendChild(titleFooter);
                        ratio.appendChild(iframe);
                        card.appendChild(ratio);
                        youtubediv.appendChild(card);
                    }
                }
            );
        }
    });
</script>
</body>

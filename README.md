# Видео с YouTube

Напишите одностраничное приложение (HTML + JavaScript + CSS) для отображения и просмотра списка видео с youtube.com. Можно использовать jQuery.

Приложению передается список идентификаторов видео (VIDEO_ID), разделенных запятой или пробелом, в GET параметре "id".

Список VIDEO_ID для примера:
```
sw-l5SW5hik,2jSWMme12ik,p8npDG2ulKQ,pl-DjiO8das,CJRw18MtRPg,Wpm07-BGJnE,xf4iv4ic70M,6Q0AazVu1Tc,Xyb1fsPG-Xk,kG41zm8HGSE,RxvcH25WThg,df7PZIVe1lw,sYvH7Y16iUM,juTa0fPI22M,2KuqjW0WtZg,dKccvk36atQ,Duc3F700lgE,TI5bEf-BULU,sxyotaytAS0,UZ47aQFp2TQ,qD2yyikDcDw,O4_JNAFClFk,iJz5jURaEBc,RBbkCEHBw_I,CX11yw6YL1w
```

Каждый VIDEO_ID имеет длину 11 символов и может содержать символы: a-z, A-Z, 0-9, -, _.
Приложение должно отобразить картинки-превью и названия видео в виде плиток. 
Ссылка на полноразмерную [картинку](https://yadi.sk/i/LB1OtwgY3VU96L)

Вид страницы должен подстраиваться под ширину браузера.
Максимальное число плиток в ряду: 3.
Соотношение длины плитки к высоте: 16/9.
Максимальный размер плитки: 480 x 270 px
Расстояние между плитками по горизонтали и вертикали: 40 px
Если ширина одной плитки превышает ширину окна браузера, размер плитки нужно пропорционально уменьшить.
Если последний ряд плиток является неполным (не хватает для него плиток), то плитки в нем нужно отображать по центру.

URL картинки-превью определяется [так](//i.ytimg.com/vi/{VIDEO_ID}/hqdefault.jpg)


URL видео (VIDEO_URL) определяется так:
`http://www.youtube.com/watch?v={VIDEO_ID}`

Название определяется GET запросом к URL:
`//noembed.com/embed?url={URLENCODED_VIDEO_URL}`
в ответ должен прийти JSON, где название находится в поле title

При клике на плитке должен появляться плеер с автозапуском воспроизведения. [Ссылка на полноразмерную картинку](https://yadi.sk/i/wTPq4d7G3VU9Hi)

При этом если на странице уже есть плеер у другой плитки, он должен скрываться.

HTML код плеера выглядит так:
```
<iframe width="{WIDTH}" height="{HEIGHT}" src="//www.youtube.com/embed/{VIDEO_ID}?autoplay=1" frameborder="0" allowfullscreen></iframe>
```

В каких браузерах должно работать:
IE 13+;
последние версии Google Chrome, Mozilla Firefox, Opera, Yandex Browser;
последние версии мобильного Google Chrome и Safari.

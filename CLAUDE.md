# Rimma Pro Hair — лендинг

## Что делаем
Лендинг для бренда Rimma Pro Hair. Верстка: чистый HTML + CSS + JS. После завершения — переносится на WordPress (способ TBD).

## Сайт-донор
https://clingr.me/ — копируем анимации и подход к вёрстке.

## Стек
- Без фреймворков, без jQuery
- BEM-нейминг
- CSS-переменные для fluid-адаптивности (см. global.css)
- IntersectionObserver для scroll-анимаций (см. main.js)
- Брейкпоинты: 568 / 768 / 980 / 1200 / 1440px

## Структура файлов
```
index.html
assets/
├── css/global.css      — переменные, normalize, анимационные классы
├── css/landing.css     — стили секций (основная работа здесь)
├── js/main.js          — IntersectionObserver
├── fonts/              — шрифты (предоставляет клиент)
└── images/             — изображения
```

## Анимационные классы (из global.css)
Добавлять на элементы — сработают при появлении в viewport:
- `.animation--fade-in` — плавное появление снизу
- `.animation--slide-up` — выезд снизу
- `.animation--image-in` — появление с лёгким zoom-out
- `.animation--image-clip-in` — раскрытие слева направо
- `.stagger-1` … `.stagger-5` — задержки для группы элементов

## Как работаем
1. Клиент скидывает скриншот секции дизайна
2. Верстаем секцию, добавляем в index.html и landing.css
3. Клиент проверяет в браузере, даёт фидбек
4. Переходим к следующей секции

## Шрифты
Ещё не предоставлены. Когда появятся — подключить в global.css через @font-face и заменить placeholder-переменные `--font-heading` и `--font-body`.

## Шрифти
- `NeverMindSerifTitle-Regular.ttf` — заголовки (font-weight: 400)
- `NeverMindSerifTitle-Medium.ttf` — заголовки (font-weight: 500)
- `Roboto-Regular.ttf` — body/UI текст
- Inter у дизайні для кнопок → замінено на Roboto (візуально ідентично)

## Кольори
- `#fff` — основний текст на hero
- `rgba(255,255,255,0.6)` — логотип
- `#000` — текст кнопки btn--white
- `#1a1a1a` — основний темний

## Зображення (поки не надані)
- `assets/images/hero-bg.webp` — фото жінки з темним волоссям (Hero section BG)
- `assets/images/logo.svg` — логотип Rimma (SVG, fill white 60% opacity, 138×43px)

## Статус
- [x] Базова структура проекту
- [x] Шрифти підключені
- [x] Секція 1 — Hero (header + h1 + опис + кнопки + venetian blind animation)
- [x] Секція 2 — Services (sticky fan-карусель, скрол+drag, 6 карток, transform-origin нижче карток)
- [x] Секція 3 — Fears (страхи перед колористом, 3 картки поверх фото)
- [x] Секція 4 — Steps (5 кроків до ідеального кольору, sticky-left + cards scroll)
- [x] Секція 5 — About («Мій фокус» — заголовок + автор зліва, бейдж «25 років», CTA-картка)
- [x] Секція 6 — Contact (карта, балун з адресою, телефон, кнопки Telegram/Viber)
- [x] Footer (логотип, копірайт, посилання, «Сайт створив ILYA PIVEN» → t.me/il_pi)
- [ ] Секції далі — чекаємо дизайн

## Зображення потрібні
- `assets/images/service-1.webp` … `service-6.webp` — фото послуг (PNG з видаленим фоном → WebP)
- `assets/images/about-photo.webp` — фото Римми (вертикальне, прозорий фон)
- `assets/images/steps-bg.webp` — тло секції Steps
- `assets/images/steps-portrait.webp` — портрет клієнтки (256×339px)
- `assets/images/contact-map.webp` — скріншот карти для Contact секції

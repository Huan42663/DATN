(self.webpackChunk_N_E=self.webpackChunk_N_E||[]).push([[3801],{88738:function(e,s,t){Promise.resolve().then(t.t.bind(t,90413,23)),Promise.resolve().then(t.t.bind(t,68326,23)),Promise.resolve().then(t.bind(t,79045)),Promise.resolve().then(t.bind(t,27036)),Promise.resolve().then(t.bind(t,6009)),Promise.resolve().then(t.bind(t,49726)),Promise.resolve().then(t.bind(t,9602)),Promise.resolve().then(t.bind(t,242)),Promise.resolve().then(t.bind(t,24592)),Promise.resolve().then(t.bind(t,68132)),Promise.resolve().then(t.bind(t,40124)),Promise.resolve().then(t.bind(t,69601)),Promise.resolve().then(t.bind(t,27785)),Promise.resolve().then(t.bind(t,26807))},6009:function(e,s,t){"use strict";t.r(s);var l=t(57437),i=t(2265),a=t(5963),r=t(10732);s.default=e=>{let{data:s,start:t,limit:n}=e,[c,d]=(0,i.useState)("on sale"),o=e=>{d(e)},m="on sale"===c?s.filter(e=>e.sale&&"fashion"===e.category):"new arrivals"===c?s.filter(e=>e.new&&"fashion"===e.category):"best sellers"===c?s.filter(e=>"fashion"===e.category).slice().sort((e,s)=>s.sold-e.sold):s;return(0,l.jsx)(l.Fragment,{children:(0,l.jsx)("div",{className:"tab-features-block md:pt-20 pt-10",children:(0,l.jsxs)("div",{className:"container",children:[(0,l.jsx)("div",{className:"heading flex flex-col items-center text-center",children:(0,l.jsx)("div",{className:"menu-tab flex items-center gap-2 p-1 bg-surface rounded-2xl",children:["best sellers","on sale","new arrivals"].map((e,s)=>(0,l.jsxs)("div",{className:"tab-item relative text-secondary heading5 py-2 px-5 cursor-pointer duration-500 hover:text-black ".concat(c===e?"active":""),onClick:()=>o(e),children:[c===e&&(0,l.jsx)(r.E.div,{layoutId:"active-pill",className:"absolute inset-0 rounded-2xl bg-white"}),(0,l.jsx)("span",{className:"relative heading5 z-[1]",children:e})]},s))})}),(0,l.jsx)("div",{className:"list-product hide-product-sold  grid lg:grid-cols-4 grid-cols-2 sm:gap-[30px] gap-[20px] md:mt-10 mt-6",children:m.slice(t,n).map((e,s)=>(0,l.jsx)(a.default,{data:e,type:"grid",style:"style-1"},s))})]})})})}},49726:function(e,s,t){"use strict";t.r(s);var l=t(57437);t(2265);var i=t(39392),a=t(97062);t(22286),t(10520),s.default=e=>{let{props:s,textColor:t}=e;return(0,l.jsx)(l.Fragment,{children:(0,l.jsx)("div",{className:"banner-top style-four w-full ".concat(s),children:(0,l.jsx)("div",{className:"container flex items-center justify-center",children:(0,l.jsx)("div",{className:"sm:w-2/3 w-full h-full",children:(0,l.jsxs)(i.tq,{spaceBetween:0,slidesPerView:1,loop:!0,navigation:!0,modules:[a.W_,a.pt],className:"h-full relative flex items-center justify-center",autoplay:{delay:3e3},children:[(0,l.jsx)(i.o5,{children:(0,l.jsx)("div",{className:"text-button-uppercase px-8 text-center ".concat(t),children:"Get 10% off on selected items"})}),(0,l.jsx)(i.o5,{children:(0,l.jsx)("div",{className:"text-button-uppercase px-8 text-center ".concat(t),children:"Free shipping on all orders over $50"})}),(0,l.jsx)(i.o5,{children:(0,l.jsx)("div",{className:"text-button-uppercase px-8 text-center ".concat(t),children:"10% off on all summer essentials!"})}),(0,l.jsx)(i.o5,{children:(0,l.jsx)("div",{className:"text-button-uppercase px-8 text-center ".concat(t),children:"Get summer-ready: 10% off swim suits"})}),(0,l.jsx)(i.o5,{children:(0,l.jsx)("div",{className:"text-button-uppercase px-8 text-center ".concat(t),children:"10% off on all product on shop"})})]})})})})})}},9602:function(e,s,t){"use strict";t.r(s);var l=t(57437),i=t(2265),a=t(16691),r=t.n(a),n=t(41156),c=t(39392),d=t(97062);t(22286);var o=t(58897),m=t(62997),h=t(4027),x=t(32618),u=t(33458);s.default=e=>{let{data:s}=e,[t,a]=(0,i.useState)(0),[p,j]=(0,i.useState)(!1),[v,f]=(0,i.useState)(!1),[g,b]=(0,i.useState)(""),[w,N]=(0,i.useState)(""),{addToCart:y,updateCart:k,cartState:P}=(0,h.useCart)(),{openModalCart:E}=(0,x.useModalCartContext)(),V=(0,i.useRef)(),S=e=>{b(e);let s=C.variation.find(s=>s.color===e);if(s){let e=C.images.indexOf(s.image);if(-1!==e){var t;null===(t=V.current)||void 0===t||t.slideTo(e)}}},H=e=>{N(e)},C=s[12],O=Math.floor(100-C.price/C.originPrice*100);return(0,l.jsx)(l.Fragment,{children:(0,l.jsx)("div",{className:"best-sale-prd bg-surface md:py-20 py-10 md:mt-20 mt-10",children:(0,l.jsxs)("div",{className:"container flex justify-between gap-y-6 flex-wrap",children:[(0,l.jsx)("div",{className:"list-img lg:w-2/3 w-full",children:(0,l.jsxs)(c.tq,{spaceBetween:12,slidesPerView:2,scrollbar:{hide:!1},modules:[d.W_,d.pt,d.LW],breakpoints:{640:{slidesPerView:3,spaceBetween:12},1024:{slidesPerView:2,spaceBetween:20}},className:"h-full",onSwiper:e=>{V.current=e},children:[(0,l.jsx)(c.o5,{children:(0,l.jsx)(r(),{src:C.images[0],width:1e3,height:1e3,alt:"prd-img",className:"w-full h-full object-cover rounded-[20px]"})}),(0,l.jsx)(c.o5,{children:(0,l.jsx)(r(),{src:C.images[1],width:1e3,height:1e3,alt:"prd-img",className:"w-full h-full object-cover rounded-[20px]"})}),(0,l.jsx)(c.o5,{children:(0,l.jsx)(r(),{src:C.images[2],width:1e3,height:1e3,alt:"prd-img",className:"w-full h-full object-cover rounded-[20px]"})}),(0,l.jsx)(c.o5,{children:(0,l.jsx)(r(),{src:C.images[3],width:1e3,height:1e3,alt:"prd-img",className:"w-full h-full object-cover rounded-[20px]"})})]})}),(0,l.jsxs)("div",{className:"product-infor lg:w-1/3 w-full lg:pl-20",children:[(0,l.jsx)("div",{className:"caption2 text-secondary font-semibold uppercase",children:C.type}),(0,l.jsx)("div",{className:"heading4 mt-1",children:C.name}),(0,l.jsxs)("div",{className:"flex items-center mt-3",children:[(0,l.jsx)(n.Z,{currentRate:C.rate,size:14}),(0,l.jsx)("span",{className:"caption1 text-secondary",children:"(1.234 reviews)"})]}),(0,l.jsxs)("div",{className:"flex items-center gap-3 flex-wrap mt-5 pb-6 border-b border-line",children:[(0,l.jsxs)("div",{className:"product-price heading5",children:["$",C.price,".00"]}),(0,l.jsx)("div",{className:"w-px h-4 bg-line"}),(0,l.jsx)("div",{className:"product-origin-price font-normal text-secondary2",children:(0,l.jsxs)("del",{children:["$",C.originPrice,".00"]})}),C.originPrice&&(0,l.jsxs)("div",{className:"product-sale caption2 font-semibold bg-green px-3 py-0.5 inline-block rounded-full",children:["-",O,"%"]}),(0,l.jsx)("div",{className:"desc text-secondary mt-3",children:C.description})]}),(0,l.jsxs)("div",{className:"list-action mt-6",children:[(0,l.jsxs)("div",{className:"choose-color",children:[(0,l.jsxs)("div",{className:"text-title",children:["Colors: ",(0,l.jsx)("span",{className:"text-title color",children:g})]}),(0,l.jsx)("div",{className:"list-color flex items-center gap-2 flex-wrap mt-3",children:C.variation.map((e,s)=>(0,l.jsxs)("div",{className:"color-item w-12 h-12 rounded-xl duration-300 relative ".concat(g===e.color?"active":""),onClick:()=>S(e.color),children:[(0,l.jsx)(r(),{src:e.colorImage,width:100,height:100,alt:"color",className:"rounded-xl"}),(0,l.jsx)("div",{className:"tag-action bg-black text-white caption2 capitalize px-1.5 py-0.5 rounded-sm",children:e.color})]},s))})]}),(0,l.jsxs)("div",{className:"choose-size mt-5",children:[(0,l.jsxs)("div",{className:"heading flex items-center justify-between",children:[(0,l.jsxs)("div",{className:"text-title",children:["Size: ",(0,l.jsx)("span",{className:"text-title size",children:w})]}),(0,l.jsx)("div",{className:"caption1 size-guide text-red underline cursor-pointer",onClick:()=>{f(!0)},children:"Size Guide"}),(0,l.jsx)(u.Z,{data:C,isOpen:v,onClose:()=>{f(!1)}})]}),(0,l.jsx)("div",{className:"list-size flex items-center gap-2 flex-wrap mt-3",children:C.sizes.map((e,s)=>(0,l.jsx)("div",{className:"size-item w-12 h-12 flex items-center justify-center text-button rounded-full bg-white border border-line ".concat(w===e?"active":""),onClick:()=>H(e),children:e},s))})]}),(0,l.jsxs)("div",{className:"choose-quantity flex items-center lg:justify-between gap-5 gap-y-3 mt-5",children:[(0,l.jsxs)("div",{className:"quantity-block md:p-3 p-2 flex items-center justify-between rounded-lg border border-line w-[140px] flex-shrink-0",children:[(0,l.jsx)(o.W,{size:20,onClick:()=>{C.quantityPurchase>1&&(C.quantityPurchase-=1,k(C.id,C.quantityPurchase-1,w,g))},className:"".concat(1===C.quantityPurchase?"disabled":""," cursor-pointer")}),(0,l.jsx)("div",{className:"body1 font-semibold",children:C.quantityPurchase}),(0,l.jsx)(m.v,{size:20,onClick:()=>{C.quantityPurchase+=1,k(C.id,C.quantityPurchase+1,w,g)},className:"cursor-pointer"})]}),(0,l.jsx)("div",{onClick:()=>{P.cartArray.find(e=>e.id===C.id)||y({...C}),k(C.id,C.quantityPurchase,w,g),E()},className:"button-main w-full text-center bg-white text-black border border-black",children:"Add To Cart"})]}),(0,l.jsx)("div",{className:"button-block mt-5",children:(0,l.jsx)("div",{className:"button-main w-full text-center",children:"Buy It Now"})})]})]})]})})})}},242:function(e,s,t){"use strict";t.r(s);var l=t(57437);t(2265);var i=t(16691),a=t.n(i),r=t(39392),n=t(97062);t(22286),s.default=()=>(0,l.jsx)(l.Fragment,{children:(0,l.jsx)("div",{className:"brand-block py-10 bg-black",children:(0,l.jsx)("div",{className:"container",children:(0,l.jsx)("div",{className:"list-brand",children:(0,l.jsxs)(r.tq,{spaceBetween:12,slidesPerView:2,loop:!0,modules:[n.pt],autoplay:{delay:4e3},breakpoints:{500:{slidesPerView:3,spaceBetween:16},680:{slidesPerView:4,spaceBetween:16},992:{slidesPerView:5,spaceBetween:16},1200:{slidesPerView:6,spaceBetween:16}},children:[(0,l.jsx)(r.o5,{children:(0,l.jsx)("div",{className:"brand-item relative flex items-center justify-center h-[40px]",children:(0,l.jsx)(a(),{src:"/images/brand/1-1.png",width:300,height:300,alt:"1",className:"h-full w-auto duration-500 relative"})})}),(0,l.jsx)(r.o5,{children:(0,l.jsx)("div",{className:"brand-item relative flex items-center justify-center h-[40px]",children:(0,l.jsx)(a(),{src:"/images/brand/2-1.png",width:300,height:300,alt:"1",className:"h-full w-auto duration-500 relative"})})}),(0,l.jsx)(r.o5,{children:(0,l.jsx)("div",{className:"brand-item relative flex items-center justify-center h-[40px]",children:(0,l.jsx)(a(),{src:"/images/brand/3-1.png",width:300,height:300,alt:"1",className:"h-full w-auto duration-500 relative"})})}),(0,l.jsx)(r.o5,{children:(0,l.jsx)("div",{className:"brand-item relative flex items-center justify-center h-[40px]",children:(0,l.jsx)(a(),{src:"/images/brand/4-1.png",width:300,height:300,alt:"1",className:"h-full w-auto duration-500 relative"})})}),(0,l.jsx)(r.o5,{children:(0,l.jsx)("div",{className:"brand-item relative flex items-center justify-center h-[40px]",children:(0,l.jsx)(a(),{src:"/images/brand/5-1.png",width:300,height:300,alt:"1",className:"h-full w-auto duration-500 relative"})})}),(0,l.jsx)(r.o5,{children:(0,l.jsx)("div",{className:"brand-item relative flex items-center justify-center h-[40px]",children:(0,l.jsx)(a(),{src:"/images/brand/6-1.png",width:300,height:300,alt:"1",className:"h-full w-auto duration-500 relative"})})})]})})})})})},24592:function(e,s,t){"use strict";t.r(s);var l=t(57437);t(2265);var i=t(16691),a=t.n(i),r=t(61396),n=t.n(r),c=t(39392),d=t(97062);t(22286);var o=t(24033);s.default=()=>{let e=(0,o.useRouter)(),s=s=>{e.push("/shop/breadcrumb1?type=".concat(s))};return(0,l.jsx)(l.Fragment,{children:(0,l.jsx)("div",{className:"collection-block style-six md:pt-20 pt-10",children:(0,l.jsxs)("div",{className:"container",children:[(0,l.jsxs)("div",{className:"heading flex items-center justify-between gap-4 gap-y-2 flex-wrap",children:[(0,l.jsx)("div",{className:"heading3",children:"Explore Collections"}),(0,l.jsx)(n(),{href:"/shop/collection",className:"text-button pb-1 border-b-2 border-black",children:"View All Collection"})]}),(0,l.jsx)("div",{className:"list-collection md:mt-10 mt-6",children:(0,l.jsxs)(c.tq,{spaceBetween:12,slidesPerView:2,loop:!0,scrollbar:{hide:!1},modules:[d.W_,d.pt,d.LW],breakpoints:{576:{slidesPerView:2,spaceBetween:12},768:{slidesPerView:3,spaceBetween:20},1200:{slidesPerView:4,spaceBetween:20}},className:"h-full pb-6",children:[(0,l.jsx)(c.o5,{children:(0,l.jsxs)("div",{className:"collection-item block relative rounded-2xl overflow-hidden cursor-pointer",onClick:()=>s("t-shirt"),children:[(0,l.jsx)("div",{className:"bg-img",children:(0,l.jsx)(a(),{src:"/images/collection/t-shirt.png",width:1e3,height:600,alt:"outerwear"})}),(0,l.jsx)("div",{className:"collection-name heading5 text-center sm:bottom-8 bottom-4 lg:w-[200px] md:w-[160px] w-[100px] md:py-3 py-1.5 bg-white rounded-xl duration-500",children:"t-shirt"})]})}),(0,l.jsx)(c.o5,{children:(0,l.jsxs)("div",{className:"collection-item block relative rounded-2xl overflow-hidden cursor-pointer",onClick:()=>s("swimwear"),children:[(0,l.jsx)("div",{className:"bg-img",children:(0,l.jsx)(a(),{src:"/images/collection/swimwear.png",width:1e3,height:600,alt:"swimwear"})}),(0,l.jsx)("div",{className:"collection-name heading5 text-center sm:bottom-8 bottom-4 lg:w-[200px] md:w-[160px] w-[100px] md:py-3 py-1.5 bg-white rounded-xl duration-500",children:"swimwear"})]})}),(0,l.jsx)(c.o5,{children:(0,l.jsxs)("div",{className:"collection-item block relative rounded-2xl overflow-hidden cursor-pointer",onClick:()=>s("top"),children:[(0,l.jsx)("div",{className:"bg-img",children:(0,l.jsx)(a(),{src:"/images/collection/top.png",width:1e3,height:600,alt:"clothes"})}),(0,l.jsx)("div",{className:"collection-name heading5 text-center sm:bottom-8 bottom-4 lg:w-[200px] md:w-[160px] w-[100px] md:py-3 py-1.5 bg-white rounded-xl duration-500",children:"top"})]})}),(0,l.jsx)(c.o5,{children:(0,l.jsxs)("div",{className:"collection-item block relative rounded-2xl overflow-hidden cursor-pointer",onClick:()=>s("sets"),children:[(0,l.jsx)("div",{className:"bg-img",children:(0,l.jsx)(a(),{src:"/images/collection/sets.png",width:1e3,height:600,alt:"sets"})}),(0,l.jsx)("div",{className:"collection-name heading5 text-center sm:bottom-8 bottom-4 lg:w-[200px] md:w-[160px] w-[100px] md:py-3 py-1.5 bg-white rounded-xl duration-500",children:"sets"})]})}),(0,l.jsx)(c.o5,{children:(0,l.jsxs)("div",{className:"collection-item block relative rounded-2xl overflow-hidden cursor-pointer",onClick:()=>s("outerwear"),children:[(0,l.jsx)("div",{className:"bg-img",children:(0,l.jsx)(a(),{src:"/images/collection/outerwear.png",width:1e3,height:600,alt:"accessories"})}),(0,l.jsx)("div",{className:"collection-name heading5 text-center sm:bottom-8 bottom-4 lg:w-[200px] md:w-[160px] w-[100px] md:py-3 py-1.5 bg-white rounded-xl duration-500",children:"outerwear"})]})}),(0,l.jsx)(c.o5,{children:(0,l.jsxs)("div",{className:"collection-item block relative rounded-2xl overflow-hidden cursor-pointer",onClick:()=>s("underwear"),children:[(0,l.jsx)("div",{className:"bg-img",children:(0,l.jsx)(a(),{src:"/images/collection/underwear.png",width:1e3,height:600,alt:"lingerie"})}),(0,l.jsx)("div",{className:"collection-name heading5 text-center sm:bottom-8 bottom-4 lg:w-[200px] md:w-[160px] w-[100px] md:py-3 py-1.5 bg-white rounded-xl duration-500",children:"underwear"})]})})]})})]})})})}},68132:function(e,s,t){"use strict";t.r(s);var l=t(57437),i=t(2265),a=t(61396),r=t.n(a),n=t(81461);s.default=()=>{let[e,s]=(0,i.useState)((0,n.m)());return(0,i.useEffect)(()=>{let e=setInterval(()=>{s((0,n.m)())},1e3);return()=>clearInterval(e)},[]),(0,l.jsx)(l.Fragment,{children:(0,l.jsx)("div",{className:"flash-sale-block style-six w-full bg-surface",children:(0,l.jsx)("div",{className:"container",children:(0,l.jsxs)("div",{className:"text-content flex items-center justify-between max-lg:flex-col max-lg:justify-center max-lg:text-center gap-5 py-10",children:[(0,l.jsxs)("div",{className:"heading",children:[(0,l.jsx)("div",{className:"heading2",children:"Flash Sale!"}),(0,l.jsx)("div",{className:"body1 mt-3",children:"Get 20% off if you spend 120$ or more!"})]}),(0,l.jsxs)("div",{className:"countdown-time flex items-center gap-5 max-sm:gap-[18px]",children:[(0,l.jsxs)("div",{className:"item flex flex-col items-center",children:[(0,l.jsx)("div",{className:"days time heading1",children:e.days<10?"0".concat(e.days):e.days}),(0,l.jsx)("div",{className:"text-button-uppercase font-medium",children:"Days"})]}),(0,l.jsx)("span",{className:"heading4",children:":"}),(0,l.jsxs)("div",{className:"item flex flex-col items-center",children:[(0,l.jsx)("div",{className:"hours time heading1",children:e.hours<10?"0".concat(e.hours):e.hours}),(0,l.jsx)("div",{className:"text-button-uppercase font-medium",children:"Hours"})]}),(0,l.jsx)("span",{className:"heading4",children:":"}),(0,l.jsxs)("div",{className:"item flex flex-col items-center",children:[(0,l.jsx)("div",{className:"minutes time heading1",children:e.minutes<10?"0".concat(e.minutes):e.minutes}),(0,l.jsx)("div",{className:"text-button-uppercase font-medium",children:"Minutes"})]}),(0,l.jsx)("span",{className:"heading4",children:":"}),(0,l.jsxs)("div",{className:"item flex flex-col items-center",children:[(0,l.jsx)("div",{className:"seconds time heading1",children:e.seconds<10?"0".concat(e.seconds):e.seconds}),(0,l.jsx)("div",{className:"text-button-uppercase font-medium",children:"Seconds"})]})]}),(0,l.jsx)(r(),{href:"/shop/breadcrumb-img",className:"button-main",children:"Get it now"})]})})})})}},27785:function(e,s,t){"use strict";t.r(s);var l=t(57437),i=t(2265),a=t(16691),r=t.n(a),n=t(61396),c=t.n(n),d=t(39392),o=t(97062);t(22286);var m=t(45220);s.default=e=>{let{data:s,limit:t}=e,[a,n]=(0,i.useState)(0);return(0,l.jsx)(l.Fragment,{children:(0,l.jsx)("div",{className:"testimonial-block style-six md:pt-20 pt-10",children:(0,l.jsxs)("div",{className:"container relative flex items-center justify-between flex-wrap gap-y-6 max-md:flex-col-reverse",children:[(0,l.jsx)("div",{className:"md:w-1/2 md:pr-12 md:py-16 w-full list-testimonial section-swiper-navigation style-small-border",children:(0,l.jsx)(d.tq,{slidesPerView:1,navigation:!0,modules:[o.W_,o.pt],className:"h-full",onSlideChange:e=>{n(e.activeIndex)},children:s.slice(0,t).map((e,s)=>(0,l.jsx)(d.o5,{"data-item":e.id,children:(0,l.jsx)(m.Z,{data:e,type:"style-six"})},e.id))})}),(0,l.jsxs)("div",{className:"list-avatar md:w-1/2 md:pl-5 md:absolute md:right-4 top-0 bottom-0 h-full text-center",children:[s.slice(0,t).map((e,s)=>(0,l.jsx)("div",{className:"bg-img rounded-[32px] overflow-hidden ".concat(s===a?"active":""),"data-item":e.id,children:(0,l.jsx)(r(),{src:e.avatar,width:1e3,height:700,alt:e.name,className:"avatar w-full h-full object-cover"})},e.id)),(0,l.jsx)(c(),{href:"/shop/breadcrumb-img",className:"text-button-uppercase font-medium text-center underline pt-5 inline-block",children:"Shop the bikini top"})]})]})})})}},33458:function(e,s,t){"use strict";var l=t(57437),i=t(2265),a=t(40589),r=t(61705);t(12353),s.Z=e=>{let{data:s,isOpen:t,onClose:n}=e,[c,d]=(0,i.useState)(""),[o,m]=(0,i.useState)({min:100,max:200}),[h,x]=(0,i.useState)({min:30,max:90}),u=(e,s)=>{e>180||s>70?d("2XL"):e>170||s>60?d("XL"):e>160||s>50?d("L"):e>155||s>45?d("M"):e>150||s>40?d("S"):d("XS")};return(0,l.jsx)(l.Fragment,{children:(0,l.jsx)("div",{className:"modal-sizeguide-block",onClick:n,children:(0,l.jsxs)("div",{className:"modal-sizeguide-main md:p-10 p-6 rounded-[32px] ".concat(t?"open":""),onClick:e=>{e.stopPropagation()},children:[(0,l.jsx)("div",{className:"close-btn absolute right-5 top-5 w-6 h-6 rounded-full bg-surface flex items-center justify-center duration-300 cursor-pointer hover:bg-black hover:text-white",onClick:n,children:(0,l.jsx)(a.X,{size:14})}),(0,l.jsx)("div",{className:"heading3",children:"Size guide"}),(0,l.jsxs)("div",{className:"md:mt-8 mt-6 progress",children:[(0,l.jsxs)("div",{className:"flex imd:items-center gap-10 justify-between max-md:flex-col gap-y-5 max-md:pr-3",children:[(0,l.jsxs)("div",{className:"flex items-center flex-shrink-0 gap-8",children:[(0,l.jsx)("span",{className:"flex-shrink-0 md:w-14",children:"Height"}),(0,l.jsxs)("div",{className:"flex items-center justify-center w-20 gap-1 py-2 border border-line rounded-lg flex-shrink-0",children:[(0,l.jsx)("span",{children:o.max}),(0,l.jsx)("span",{className:"caption1 text-secondary",children:"Cm"})]})]}),(0,l.jsx)(r.Z,{range:!0,defaultValue:[100,200],min:100,max:200,onChange:e=>{Array.isArray(e)&&m({min:e[0],max:e[1]}),u(o.max,h.max)}})]}),(0,l.jsxs)("div",{className:"flex md:items-center gap-10 justify-between max-md:flex-col gap-y-5 max-md:pr-3 mt-5",children:[(0,l.jsxs)("div",{className:"flex items-center gap-8 flex-shrink-0",children:[(0,l.jsx)("span",{className:"flex-shrink-0 md:w-14",children:"Weight"}),(0,l.jsxs)("div",{className:"flex items-center justify-center w-20 gap-1 py-2 border border-line rounded-lg flex-shrink-0",children:[(0,l.jsx)("span",{children:h.max}),(0,l.jsx)("span",{className:"caption1 text-secondary",children:"Kg"})]})]}),(0,l.jsx)(r.Z,{range:!0,defaultValue:[30,90],min:30,max:90,onChange:e=>{Array.isArray(e)&&x({min:e[0],max:e[1]}),u(o.max,h.max)}})]})]}),(0,l.jsx)("div",{className:"heading6 mt-8",children:"suggests for you:"}),(0,l.jsx)("div",{className:"list-size flex items-center gap-2 flex-wrap mt-3",children:null==s?void 0:s.sizes.map((e,s)=>(0,l.jsx)("div",{className:"size-item w-12 h-12 flex items-center justify-center text-button rounded-full bg-white border border-line ".concat(c===e?"active":""),children:e},s))}),(0,l.jsxs)("table",{children:[(0,l.jsx)("thead",{children:(0,l.jsxs)("tr",{children:[(0,l.jsx)("th",{children:"Size"}),(0,l.jsx)("th",{children:"Bust"}),(0,l.jsx)("th",{children:"Waist"}),(0,l.jsx)("th",{children:"Low Hip"})]})}),(0,l.jsxs)("tbody",{children:[(0,l.jsxs)("tr",{children:[(0,l.jsx)("td",{children:"XS"}),(0,l.jsx)("td",{children:"32"}),(0,l.jsx)("td",{children:"24-25"}),(0,l.jsx)("td",{children:"33-34"})]}),(0,l.jsxs)("tr",{children:[(0,l.jsx)("td",{children:"S"}),(0,l.jsx)("td",{children:"34-35"}),(0,l.jsx)("td",{children:"26-27"}),(0,l.jsx)("td",{children:"35-36"})]}),(0,l.jsxs)("tr",{children:[(0,l.jsx)("td",{children:"M"}),(0,l.jsx)("td",{children:"36-37"}),(0,l.jsx)("td",{children:"28-29"}),(0,l.jsx)("td",{children:"38-40"})]}),(0,l.jsxs)("tr",{children:[(0,l.jsx)("td",{children:"L"}),(0,l.jsx)("td",{children:"38-39"}),(0,l.jsx)("td",{children:"30-31"}),(0,l.jsx)("td",{children:"42-44"})]}),(0,l.jsxs)("tr",{children:[(0,l.jsx)("td",{children:"XL"}),(0,l.jsx)("td",{children:"40-41"}),(0,l.jsx)("td",{children:"32-33"}),(0,l.jsx)("td",{children:"45-47"})]}),(0,l.jsxs)("tr",{children:[(0,l.jsx)("td",{children:"2XL"}),(0,l.jsx)("td",{children:"42-43"}),(0,l.jsx)("td",{children:"34-35"}),(0,l.jsx)("td",{children:"48-50"})]})]})]})]})})})}},26807:function(e,s,t){"use strict";t.r(s);var l=t(57437);t(2265);var i=t(16691),a=t.n(i),r=t(61396),n=t.n(r),c=t(39392),d=t(97062);t(22286),t(10520),s.default=()=>(0,l.jsx)(l.Fragment,{children:(0,l.jsx)("div",{className:"slider-block style-one bg-[#F5EEE7] xl:h-[860px] lg:h-[800px] md:h-[580px] sm:h-[500px] h-[350px] max-[420px]:h-[320px] w-full",children:(0,l.jsx)("div",{className:"slider-main h-full w-full",children:(0,l.jsxs)(c.tq,{spaceBetween:0,slidesPerView:1,loop:!0,pagination:{clickable:!0},modules:[d.tl,d.pt],className:"h-full relative",autoplay:{delay:4e3},children:[(0,l.jsx)(c.o5,{children:(0,l.jsx)("div",{className:"slider-item h-full w-full relative overflow-hidden",children:(0,l.jsxs)("div",{className:"container w-full h-full flex items-center relative",children:[(0,l.jsxs)("div",{className:"text-content basis-1/2",children:[(0,l.jsx)("div",{className:"text-sub-display",children:"Sale! Up To 50% Off!"}),(0,l.jsx)("div",{className:"text-display md:mt-5 mt-2",children:"Summer Sale Collections"}),(0,l.jsx)(n(),{href:"/shop/breadcrumb-img",className:"button-main md:mt-8 mt-3",children:"Shop Now"})]}),(0,l.jsx)("div",{className:"sub-img absolute sm:w-[55%] w-3/5 2xl:-right-[60px] -right-[16px] bottom-0",children:(0,l.jsx)(a(),{src:"/images/slider/bg6-1.png",width:2e3,height:1936,alt:"bg6-1",priority:!0,className:"w-full"})})]})})}),(0,l.jsx)(c.o5,{children:(0,l.jsx)("div",{className:"slider-item h-full w-full relative overflow-hidden",children:(0,l.jsxs)("div",{className:"container w-full h-full flex items-center relative",children:[(0,l.jsxs)("div",{className:"text-content basis-1/2",children:[(0,l.jsx)("div",{className:"text-sub-display",children:"Sale! Up To 50% Off!"}),(0,l.jsx)("div",{className:"text-display md:mt-5 mt-2",children:"Fashion for Every Occasion"}),(0,l.jsx)(n(),{href:"/shop/breadcrumb-img",className:"button-main md:mt-8 mt-3",children:"Shop Now"})]}),(0,l.jsx)("div",{className:"sub-img absolute w-1/2 right-[0] sm:-bottom-7 bottom-0",children:(0,l.jsx)(a(),{src:"/images/slider/bg6-2.png",width:2e3,height:1936,alt:"bg6-2",priority:!0,className:"w-full"})})]})})}),(0,l.jsx)(c.o5,{children:(0,l.jsx)("div",{className:"slider-item h-full w-full relative overflow-hidden",children:(0,l.jsxs)("div",{className:"container w-full h-full flex items-center relative",children:[(0,l.jsxs)("div",{className:"text-content basis-1/2",children:[(0,l.jsx)("div",{className:"text-sub-display",children:"Sale! Up To 50% Off!"}),(0,l.jsx)("div",{className:"text-display md:mt-5 mt-2",children:"Stylish Looks for Any Season"}),(0,l.jsx)(n(),{href:"/shop/breadcrumb-img",className:"button-main md:mt-8 mt-3",children:"Shop Now"})]}),(0,l.jsx)("div",{className:"sub-img absolute sm:w-3/5 w-2/3 2xl:-right-[60px] -right-[36px] bottom-0 sm:-bottom-[30px]",children:(0,l.jsx)(a(),{src:"/images/slider/bg6-3.png",width:2e3,height:2e3,alt:"bg6-3",priority:!0,className:"w-full"})})]})})})]})})})})},10520:function(){},58897:function(e,s,t){"use strict";t.d(s,{W:function(){return p}});var l=t(2265),i=t(93851);let a=new Map([["bold",l.createElement(l.Fragment,null,l.createElement("path",{d:"M228,128a12,12,0,0,1-12,12H40a12,12,0,0,1,0-24H216A12,12,0,0,1,228,128Z"}))],["duotone",l.createElement(l.Fragment,null,l.createElement("path",{d:"M216,48V208a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V48a8,8,0,0,1,8-8H208A8,8,0,0,1,216,48Z",opacity:"0.2"}),l.createElement("path",{d:"M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128Z"}))],["fill",l.createElement(l.Fragment,null,l.createElement("path",{d:"M208,32H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM184,136H72a8,8,0,0,1,0-16H184a8,8,0,0,1,0,16Z"}))],["light",l.createElement(l.Fragment,null,l.createElement("path",{d:"M222,128a6,6,0,0,1-6,6H40a6,6,0,0,1,0-12H216A6,6,0,0,1,222,128Z"}))],["regular",l.createElement(l.Fragment,null,l.createElement("path",{d:"M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128Z"}))],["thin",l.createElement(l.Fragment,null,l.createElement("path",{d:"M220,128a4,4,0,0,1-4,4H40a4,4,0,0,1,0-8H216A4,4,0,0,1,220,128Z"}))]]);var r=Object.defineProperty,n=Object.defineProperties,c=Object.getOwnPropertyDescriptors,d=Object.getOwnPropertySymbols,o=Object.prototype.hasOwnProperty,m=Object.prototype.propertyIsEnumerable,h=(e,s,t)=>s in e?r(e,s,{enumerable:!0,configurable:!0,writable:!0,value:t}):e[s]=t,x=(e,s)=>{for(var t in s||(s={}))o.call(s,t)&&h(e,t,s[t]);if(d)for(var t of d(s))m.call(s,t)&&h(e,t,s[t]);return e},u=(e,s)=>n(e,c(s));let p=(0,l.forwardRef)((e,s)=>l.createElement(i.Z,u(x({ref:s},e),{weights:a})));p.displayName="Minus"},62997:function(e,s,t){"use strict";t.d(s,{v:function(){return p}});var l=t(2265),i=t(93851);let a=new Map([["bold",l.createElement(l.Fragment,null,l.createElement("path",{d:"M228,128a12,12,0,0,1-12,12H140v76a12,12,0,0,1-24,0V140H40a12,12,0,0,1,0-24h76V40a12,12,0,0,1,24,0v76h76A12,12,0,0,1,228,128Z"}))],["duotone",l.createElement(l.Fragment,null,l.createElement("path",{d:"M216,48V208a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V48a8,8,0,0,1,8-8H208A8,8,0,0,1,216,48Z",opacity:"0.2"}),l.createElement("path",{d:"M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z"}))],["fill",l.createElement(l.Fragment,null,l.createElement("path",{d:"M208,32H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM184,136H136v48a8,8,0,0,1-16,0V136H72a8,8,0,0,1,0-16h48V72a8,8,0,0,1,16,0v48h48a8,8,0,0,1,0,16Z"}))],["light",l.createElement(l.Fragment,null,l.createElement("path",{d:"M222,128a6,6,0,0,1-6,6H134v82a6,6,0,0,1-12,0V134H40a6,6,0,0,1,0-12h82V40a6,6,0,0,1,12,0v82h82A6,6,0,0,1,222,128Z"}))],["regular",l.createElement(l.Fragment,null,l.createElement("path",{d:"M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z"}))],["thin",l.createElement(l.Fragment,null,l.createElement("path",{d:"M220,128a4,4,0,0,1-4,4H132v84a4,4,0,0,1-8,0V132H40a4,4,0,0,1,0-8h84V40a4,4,0,0,1,8,0v84h84A4,4,0,0,1,220,128Z"}))]]);var r=Object.defineProperty,n=Object.defineProperties,c=Object.getOwnPropertyDescriptors,d=Object.getOwnPropertySymbols,o=Object.prototype.hasOwnProperty,m=Object.prototype.propertyIsEnumerable,h=(e,s,t)=>s in e?r(e,s,{enumerable:!0,configurable:!0,writable:!0,value:t}):e[s]=t,x=(e,s)=>{for(var t in s||(s={}))o.call(s,t)&&h(e,t,s[t]);if(d)for(var t of d(s))m.call(s,t)&&h(e,t,s[t]);return e},u=(e,s)=>n(e,c(s));let p=(0,l.forwardRef)((e,s)=>l.createElement(i.Z,u(x({ref:s},e),{weights:a})));p.displayName="Plus"}},function(e){e.O(0,[4096,6691,4523,5283,601,732,7847,9295,167,2971,2472,1744],function(){return e(e.s=88738)}),_N_E=e.O()}]);
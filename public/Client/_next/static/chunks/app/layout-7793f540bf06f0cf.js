(self.webpackChunk_N_E=self.webpackChunk_N_E||[]).push([[3185],{4737:function(e,s,i){Promise.resolve().then(i.t.bind(i,5628,23)),Promise.resolve().then(i.bind(i,32835)),Promise.resolve().then(i.bind(i,35874)),Promise.resolve().then(i.bind(i,33511)),Promise.resolve().then(i.bind(i,37389)),Promise.resolve().then(i.bind(i,66106)),Promise.resolve().then(i.bind(i,4027)),Promise.resolve().then(i.bind(i,95517)),Promise.resolve().then(i.bind(i,32618)),Promise.resolve().then(i.bind(i,2340)),Promise.resolve().then(i.bind(i,88103)),Promise.resolve().then(i.bind(i,41629)),Promise.resolve().then(i.bind(i,78363)),Promise.resolve().then(i.bind(i,55811)),Promise.resolve().then(i.t.bind(i,72061,23))},32835:function(e,s,i){"use strict";i.r(s);var t=i(57437),l=i(2265),r=i(61396),a=i.n(r),c=i(16691),n=i.n(c),d=i(79376),o=i(40589),x=i(43074),m=i(11166),h=i(51906),p=i(29981),u=i(25153),j=i(32618),v=i(4027),b=i(81461);s.default=e=>{let{serverTimeLeft:s}=e,[i,r]=(0,l.useState)(s);(0,l.useEffect)(()=>{let e=setInterval(()=>{r((0,b.m)())},1e3);return()=>clearInterval(e)},[]);let[c,f]=(0,l.useState)(""),{isModalOpen:N,closeModalCart:g}=(0,j.useModalCartContext)(),{cartState:w,addToCart:y,removeFromCart:k,updateCart:C}=(0,v.useCart)(),P=e=>{w.cartArray.find(s=>s.id===e.id)||y({...e}),C(e.id,e.quantityPurchase,"","")},S=e=>{f(e)},[z,A]=(0,l.useState)(0),[M,F]=(0,l.useState)(0);return w.cartArray.map(e=>z+=e.price*e.quantity),(0,t.jsx)(t.Fragment,{children:(0,t.jsx)("div",{className:"modal-cart-block",onClick:g,children:(0,t.jsxs)("div",{className:"modal-cart-main flex ".concat(N?"open":""),onClick:e=>{e.stopPropagation()},children:[(0,t.jsxs)("div",{className:"left w-1/2 border-r border-line py-6 max-md:hidden",children:[(0,t.jsx)("div",{className:"heading5 px-6 pb-3",children:"You May Also Like"}),(0,t.jsx)("div",{className:"list px-6",children:u.slice(0,4).map(e=>(0,t.jsxs)("div",{className:"item py-5 flex items-center justify-between gap-3 border-b border-line",children:[(0,t.jsxs)("div",{className:"infor flex items-center gap-5",children:[(0,t.jsx)("div",{className:"bg-img",children:(0,t.jsx)(n(),{src:e.images[0],width:300,height:300,alt:e.name,className:"w-[100px] aspect-square flex-shrink-0 rounded-lg"})}),(0,t.jsxs)("div",{className:"",children:[(0,t.jsx)("div",{className:"name text-button",children:e.name}),(0,t.jsxs)("div",{className:"flex items-center gap-2 mt-2",children:[(0,t.jsxs)("div",{className:"product-price text-title",children:["$",e.price,".00"]}),(0,t.jsx)("div",{className:"product-origin-price text-title text-secondary2",children:(0,t.jsxs)("del",{children:["$",e.originPrice,".00"]})})]})]})]}),(0,t.jsx)("div",{className:"text-xl bg-white w-10 h-10 rounded-xl border border-black flex items-center justify-center duration-300 cursor-pointer hover:bg-black hover:text-white",onClick:s=>{s.stopPropagation(),P(e)},children:(0,t.jsx)(d.J,{})})]},e.id))})]}),(0,t.jsxs)("div",{className:"right cart-block md:w-1/2 w-full py-6 relative overflow-hidden",children:[(0,t.jsxs)("div",{className:"heading px-6 pb-3 flex items-center justify-between relative",children:[(0,t.jsx)("div",{className:"heading5",children:"Shopping Cart"}),(0,t.jsx)("div",{className:"close-btn absolute right-6 top-0 w-6 h-6 rounded-full bg-surface flex items-center justify-center duration-300 cursor-pointer hover:bg-black hover:text-white",onClick:g,children:(0,t.jsx)(o.X,{size:14})})]}),(0,t.jsx)("div",{className:"time px-6",children:(0,t.jsxs)("div",{className:" flex items-center gap-3 px-5 py-3 bg-green rounded-lg",children:[(0,t.jsx)("p",{className:"text-3xl",children:"\uD83D\uDD25"}),(0,t.jsxs)("div",{className:"caption1",children:["Your cart will expire in ",(0,t.jsxs)("span",{className:"text-red caption1 font-semibold",children:[i.minutes,":",i.seconds<10?"0".concat(i.seconds):i.seconds]})," minutes!",(0,t.jsx)("br",{}),"Please checkout now before your items sell out!"]})]})}),(0,t.jsxs)("div",{className:"heading banner mt-3 px-6",children:[(0,t.jsxs)("div",{className:"text",children:["Buy ",(0,t.jsxs)("span",{className:"text-button",children:[" $",(0,t.jsx)("span",{className:"more-price",children:150-z>0?(0,t.jsx)(t.Fragment,{children:150-z}):0}),".00 "]}),(0,t.jsx)("span",{children:"more to get "}),(0,t.jsx)("span",{className:"text-button",children:"freeship"})]}),(0,t.jsx)("div",{className:"tow-bar-block mt-3",children:(0,t.jsx)("div",{className:"progress-line",style:{width:z<=150?"".concat(z/150*100,"%"):"100%"}})})]}),(0,t.jsx)("div",{className:"list-product px-6",children:w.cartArray.map(e=>(0,t.jsx)("div",{className:"item py-5 flex items-center justify-between gap-3 border-b border-line",children:(0,t.jsxs)("div",{className:"infor flex items-center gap-3 w-full",children:[(0,t.jsx)("div",{className:"bg-img w-[100px] aspect-square flex-shrink-0 rounded-lg overflow-hidden",children:(0,t.jsx)(n(),{src:e.images[0],width:300,height:300,alt:e.name,className:"w-full h-full"})}),(0,t.jsxs)("div",{className:"w-full",children:[(0,t.jsxs)("div",{className:"flex items-center justify-between w-full",children:[(0,t.jsx)("div",{className:"name text-button",children:e.name}),(0,t.jsx)("div",{className:"remove-cart-btn caption1 font-semibold text-red underline cursor-pointer",onClick:()=>k(e.id),children:"Remove"})]}),(0,t.jsxs)("div",{className:"flex items-center justify-between gap-2 mt-3 w-full",children:[(0,t.jsxs)("div",{className:"flex items-center text-secondary2 capitalize",children:[e.selectedSize||e.sizes[0],"/",e.selectedColor||e.variation[0].color]}),(0,t.jsxs)("div",{className:"product-price text-title",children:["$",e.price,".00"]})]})]})]})},e.id))}),(0,t.jsxs)("div",{className:"footer-modal bg-white absolute bottom-0 left-0 w-full",children:[(0,t.jsxs)("div",{className:"flex items-center justify-center lg:gap-14 gap-8 px-6 py-4 border-b border-line",children:[(0,t.jsxs)("div",{className:"item flex items-center gap-3 cursor-pointer",onClick:()=>S("note"),children:[(0,t.jsx)(x.a,{className:"text-xl"}),(0,t.jsx)("div",{className:"caption1",children:"Note"})]}),(0,t.jsxs)("div",{className:"item flex items-center gap-3 cursor-pointer",onClick:()=>S("shipping"),children:[(0,t.jsx)(m._,{className:"text-xl"}),(0,t.jsx)("div",{className:"caption1",children:"Shipping"})]}),(0,t.jsxs)("div",{className:"item flex items-center gap-3 cursor-pointer",onClick:()=>S("coupon"),children:[(0,t.jsx)(h.V,{className:"text-xl"}),(0,t.jsx)("div",{className:"caption1",children:"Coupon"})]})]}),(0,t.jsxs)("div",{className:"flex items-center justify-between pt-6 px-6",children:[(0,t.jsx)("div",{className:"heading5",children:"Subtotal"}),(0,t.jsxs)("div",{className:"heading5",children:["$",z,".00"]})]}),(0,t.jsxs)("div",{className:"block-button text-center p-6",children:[(0,t.jsxs)("div",{className:"flex items-center gap-4",children:[(0,t.jsx)(a(),{href:"/cart",className:"button-main basis-1/2 bg-white border border-black text-black text-center uppercase",onClick:g,children:"View cart"}),(0,t.jsx)(a(),{href:"/checkout",className:"button-main basis-1/2 text-center uppercase",onClick:g,children:"Check Out"})]}),(0,t.jsx)("div",{onClick:g,className:"text-button-uppercase mt-4 text-center has-line-before cursor-pointer inline-block",children:"Or continue shopping"})]}),(0,t.jsxs)("div",{className:"tab-item note-block ".concat("note"===c?"active":""),children:[(0,t.jsx)("div",{className:"px-6 py-4 border-b border-line",children:(0,t.jsxs)("div",{className:"item flex items-center gap-3 cursor-pointer",children:[(0,t.jsx)(x.a,{className:"text-xl"}),(0,t.jsx)("div",{className:"caption1",children:"Note"})]})}),(0,t.jsx)("div",{className:"form pt-4 px-6",children:(0,t.jsx)("textarea",{name:"form-note",id:"form-note",rows:4,placeholder:"Add special instructions for your order...",className:"caption1 py-3 px-4 bg-surface border-line rounded-md w-full"})}),(0,t.jsxs)("div",{className:"block-button text-center pt-4 px-6 pb-6",children:[(0,t.jsx)("div",{className:"button-main w-full text-center",onClick:()=>f(""),children:"Save"}),(0,t.jsx)("div",{onClick:()=>f(""),className:"text-button-uppercase mt-4 text-center has-line-before cursor-pointer inline-block",children:"Cancel"})]})]}),(0,t.jsxs)("div",{className:"tab-item note-block ".concat("shipping"===c?"active":""),children:[(0,t.jsx)("div",{className:"px-6 py-4 border-b border-line",children:(0,t.jsxs)("div",{className:"item flex items-center gap-3 cursor-pointer",children:[(0,t.jsx)(m._,{className:"text-xl"}),(0,t.jsx)("div",{className:"caption1",children:"Estimate shipping rates"})]})}),(0,t.jsxs)("div",{className:"form pt-4 px-6",children:[(0,t.jsxs)("div",{className:"",children:[(0,t.jsx)("label",{htmlFor:"select-country",className:"caption1 text-secondary",children:"Country/region"}),(0,t.jsxs)("div",{className:"select-block relative mt-2",children:[(0,t.jsxs)("select",{id:"select-country",name:"select-country",className:"w-full py-3 pl-5 rounded-xl bg-white border border-line",defaultValue:"Country/region",children:[(0,t.jsx)("option",{value:"Country/region",disabled:!0,children:"Country/region"}),(0,t.jsx)("option",{value:"France",children:"France"}),(0,t.jsx)("option",{value:"Spain",children:"Spain"}),(0,t.jsx)("option",{value:"UK",children:"UK"}),(0,t.jsx)("option",{value:"USA",children:"USA"})]}),(0,t.jsx)(p.p,{size:12,className:"absolute top-1/2 -translate-y-1/2 md:right-5 right-2"})]})]}),(0,t.jsxs)("div",{className:"mt-3",children:[(0,t.jsx)("label",{htmlFor:"select-state",className:"caption1 text-secondary",children:"State"}),(0,t.jsxs)("div",{className:"select-block relative mt-2",children:[(0,t.jsxs)("select",{id:"select-state",name:"select-state",className:"w-full py-3 pl-5 rounded-xl bg-white border border-line",defaultValue:"State",children:[(0,t.jsx)("option",{value:"State",disabled:!0,children:"State"}),(0,t.jsx)("option",{value:"Paris",children:"Paris"}),(0,t.jsx)("option",{value:"Madrid",children:"Madrid"}),(0,t.jsx)("option",{value:"London",children:"London"}),(0,t.jsx)("option",{value:"New York",children:"New York"})]}),(0,t.jsx)(p.p,{size:12,className:"absolute top-1/2 -translate-y-1/2 md:right-5 right-2"})]})]}),(0,t.jsxs)("div",{className:"mt-3",children:[(0,t.jsx)("label",{htmlFor:"select-code",className:"caption1 text-secondary",children:"Postal/Zip Code"}),(0,t.jsx)("input",{className:"border-line px-5 py-3 w-full rounded-xl mt-3",id:"select-code",type:"text",placeholder:"Postal/Zip Code"})]})]}),(0,t.jsxs)("div",{className:"block-button text-center pt-4 px-6 pb-6",children:[(0,t.jsx)("div",{className:"button-main w-full text-center",onClick:()=>f(""),children:"Calculator"}),(0,t.jsx)("div",{onClick:()=>f(""),className:"text-button-uppercase mt-4 text-center has-line-before cursor-pointer inline-block",children:"Cancel"})]})]}),(0,t.jsxs)("div",{className:"tab-item note-block ".concat("coupon"===c?"active":""),children:[(0,t.jsx)("div",{className:"px-6 py-4 border-b border-line",children:(0,t.jsxs)("div",{className:"item flex items-center gap-3 cursor-pointer",children:[(0,t.jsx)(h.V,{className:"text-xl"}),(0,t.jsx)("div",{className:"caption1",children:"Add A Coupon Code"})]})}),(0,t.jsx)("div",{className:"form pt-4 px-6",children:(0,t.jsxs)("div",{className:"",children:[(0,t.jsx)("label",{htmlFor:"select-discount",className:"caption1 text-secondary",children:"Enter Code"}),(0,t.jsx)("input",{className:"border-line px-5 py-3 w-full rounded-xl mt-3",id:"select-discount",type:"text",placeholder:"Discount code"})]})}),(0,t.jsxs)("div",{className:"block-button text-center pt-4 px-6 pb-6",children:[(0,t.jsx)("div",{className:"button-main w-full text-center",onClick:()=>f(""),children:"Apply"}),(0,t.jsx)("div",{onClick:()=>f(""),className:"text-button-uppercase mt-4 text-center has-line-before cursor-pointer inline-block",children:"Cancel"})]})]})]})]})]})})})}},35874:function(e,s,i){"use strict";i.r(s);var t=i(57437);i(2265);var l=i(61396),r=i.n(l),a=i(16691),c=i.n(a),n=i(40589),d=i(2340),o=i(95517);s.default=()=>{let{isModalOpen:e,closeModalCompare:s}=(0,d.useModalCompareContext)(),{compareState:i,removeFromCompare:l}=(0,o.useCompare)();return(0,t.jsx)(t.Fragment,{children:(0,t.jsx)("div",{className:"modal-compare-block",children:(0,t.jsxs)("div",{className:"modal-compare-main py-6 ".concat(e?"open":""),onClick:e=>{e.stopPropagation()},children:[(0,t.jsx)("div",{className:"close-btn absolute 2xl:right-6 right-4 2xl:top-6 md:-top-4 top-3 lg:w-10 w-6 lg:h-10 h-6 rounded-full bg-surface flex items-center justify-center duration-300 cursor-pointer hover:bg-black hover:text-white",onClick:s,children:(0,t.jsx)(n.X,{className:"body1"})}),(0,t.jsx)("div",{className:"container h-full flex items-center w-full",children:(0,t.jsxs)("div",{className:"content-main flex items-center justify-between xl:gap-10 gap-6 w-full max-md:flex-wrap",children:[(0,t.jsxs)("div",{className:"heading5 flex-shrink-0 max-md:w-full",children:["Compare ",(0,t.jsx)("br",{className:"max-md:hidden"}),"Products"]}),(0,t.jsx)("div",{className:"list-product flex items-center w-full gap-4",children:i.compareArray.slice(0,3).map(e=>(0,t.jsxs)("div",{className:"item p-3 border border-line rounded-xl relative",children:[(0,t.jsxs)("div",{className:"infor flex items-center gap-4",children:[(0,t.jsx)("div",{className:"bg-img w-[100px] h-[100px] flex-shrink-0 rounded-lg overflow-hidden",children:(0,t.jsx)(c(),{src:e.images[0],width:500,height:500,alt:e.name,className:"w-full h-full"})}),(0,t.jsxs)("div",{className:"",children:[(0,t.jsx)("div",{className:"name text-title",children:e.name}),(0,t.jsxs)("div",{className:"product-price text-title mt-2",children:["$",e.price,".00"]})]})]}),(0,t.jsx)("div",{className:"close-btn absolute -right-4 -top-4 w-8 h-8 rounded-full bg-red text-white flex items-center justify-center duration-300 cursor-pointer hover:bg-black",onClick:()=>l(e.id),children:(0,t.jsx)(n.X,{size:14})})]},e.id))}),(0,t.jsxs)("div",{className:"block-button flex flex-col gap-4 flex-shrink-0",children:[i.compareArray.length<2?(0,t.jsx)(t.Fragment,{children:(0,t.jsx)("a",{href:"#!",className:"button-main whitespace-nowrap",onClick:e=>{e.stopPropagation(),alert("Minimum 2 products required to compare!")},children:"Compare Products"})}):(0,t.jsx)(t.Fragment,{children:(0,t.jsx)(r(),{href:"/compare",onClick:s,className:"button-main whitespace-nowrap",children:"Compare Products"})}),(0,t.jsx)("div",{onClick:()=>{s(),i.compareArray.length=0},className:"button-main whitespace-nowrap border border-black bg-white text-black",children:"Clear All Products"})]})]})})]})})})}},33511:function(e,s,i){"use strict";i.r(s);var t=i(57437),l=i(2265),r=i(16691),a=i.n(r),c=i(40589),n=i(45847),d=i(58897),o=i(62997),x=i(95441),m=i(76719),h=i(2239),p=i(7471),u=i(6396),j=i(14815),v=i(88103),b=i(4027),f=i(32618),N=i(55811),g=i(78363),w=i(95517),y=i(2340),k=i(41156),C=i(33458);s.default=()=>{let[e,s]=(0,l.useState)(0),[i,r]=(0,l.useState)(!1),[P,S]=(0,l.useState)(!1),{selectedProduct:z,closeQuickview:A}=(0,v.useModalQuickviewContext)(),[M,F]=(0,l.useState)(""),[q,X]=(0,l.useState)(""),{addToCart:L,updateCart:D,cartState:$}=(0,b.useCart)(),{openModalCart:E}=(0,f.useModalCartContext)(),{addToWishlist:V,removeFromWishlist:W,wishlistState:_}=(0,N.useWishlist)(),{openModalWishlist:T}=(0,g.useModalWishlistContext)(),{addToCompare:Z,removeFromCompare:O,compareState:R}=(0,w.useCompare)(),{openModalCompare:U}=(0,y.useModalCompareContext)(),K=z&&Math.floor(100-z.price/z.originPrice*100),Y=e=>{F(e)},B=e=>{X(e)};return(0,t.jsx)(t.Fragment,{children:(0,t.jsx)("div",{className:"modal-quickview-block",onClick:A,children:(0,t.jsx)("div",{className:"modal-quickview-main py-6 ".concat(null!==z?"open":""),onClick:e=>{e.stopPropagation()},children:(0,t.jsxs)("div",{className:"flex h-full max-md:flex-col-reverse gap-y-6",children:[(0,t.jsx)("div",{className:"left lg:w-[388px] md:w-[300px] flex-shrink-0 px-6",children:(0,t.jsx)("div",{className:"list-img max-md:flex items-center gap-4",children:null==z?void 0:z.images.map((e,s)=>(0,t.jsx)("div",{className:"bg-img w-full aspect-[3/4] max-md:w-[150px] max-md:flex-shrink-0 rounded-[20px] overflow-hidden md:mt-6",children:(0,t.jsx)(a(),{src:e,width:1500,height:2e3,alt:e,priority:!0,className:"w-full h-full object-cover"})},s))})}),(0,t.jsxs)("div",{className:"right w-full px-4",children:[(0,t.jsxs)("div",{className:"heading pb-6 px-4 flex items-center justify-between relative",children:[(0,t.jsx)("div",{className:"heading5",children:"Quick View"}),(0,t.jsx)("div",{className:"close-btn absolute right-0 top-0 w-6 h-6 rounded-full bg-surface flex items-center justify-center duration-300 cursor-pointer hover:bg-black hover:text-white",onClick:A,children:(0,t.jsx)(c.X,{size:14})})]}),(0,t.jsxs)("div",{className:"product-infor px-4",children:[(0,t.jsxs)("div",{className:"flex justify-between",children:[(0,t.jsxs)("div",{children:[(0,t.jsx)("div",{className:"caption2 text-secondary font-semibold uppercase",children:null==z?void 0:z.type}),(0,t.jsx)("div",{className:"heading4 mt-1",children:null==z?void 0:z.name})]}),(0,t.jsx)("div",{className:"add-wishlist-btn w-10 h-10 flex items-center justify-center border border-line cursor-pointer rounded-lg duration-300 flex-shrink-0 hover:bg-black hover:text-white ".concat(_.wishlistArray.some(e=>e.id===(null==z?void 0:z.id))?"active":""),onClick:()=>{z&&(_.wishlistArray.some(e=>e.id===z.id)?W(z.id):V(z)),T()},children:_.wishlistArray.some(e=>e.id===(null==z?void 0:z.id))?(0,t.jsx)(t.Fragment,{children:(0,t.jsx)(n.X,{size:20,weight:"fill",className:"text-red"})}):(0,t.jsx)(t.Fragment,{children:(0,t.jsx)(n.X,{size:20})})})]}),(0,t.jsxs)("div",{className:"flex items-center mt-3",children:[(0,t.jsx)(k.Z,{currentRate:null==z?void 0:z.rate,size:14}),(0,t.jsx)("span",{className:"caption1 text-secondary",children:"(1.234 reviews)"})]}),(0,t.jsxs)("div",{className:"flex items-center gap-3 flex-wrap mt-5 pb-6 border-b border-line",children:[(0,t.jsxs)("div",{className:"product-price heading5",children:["$",null==z?void 0:z.price,".00"]}),(0,t.jsx)("div",{className:"w-px h-4 bg-line"}),(0,t.jsx)("div",{className:"product-origin-price font-normal text-secondary2",children:(0,t.jsxs)("del",{children:["$",null==z?void 0:z.originPrice,".00"]})}),(null==z?void 0:z.originPrice)&&(0,t.jsxs)("div",{className:"product-sale caption2 font-semibold bg-green px-3 py-0.5 inline-block rounded-full",children:["-",K,"%"]}),(0,t.jsx)("div",{className:"desc text-secondary mt-3",children:null==z?void 0:z.description})]}),(0,t.jsxs)("div",{className:"list-action mt-6",children:[(0,t.jsxs)("div",{className:"choose-color",children:[(0,t.jsxs)("div",{className:"text-title",children:["Colors: ",(0,t.jsx)("span",{className:"text-title color",children:M})]}),(0,t.jsx)("div",{className:"list-color flex items-center gap-2 flex-wrap mt-3",children:null==z?void 0:z.variation.map((e,s)=>(0,t.jsxs)("div",{className:"color-item w-12 h-12 rounded-xl duration-300 relative ".concat(M===e.color?"active":""),datatype:e.image,onClick:()=>{Y(e.color)},children:[(0,t.jsx)(a(),{src:e.colorImage,width:100,height:100,alt:"color",className:"rounded-xl"}),(0,t.jsx)("div",{className:"tag-action bg-black text-white caption2 capitalize px-1.5 py-0.5 rounded-sm",children:e.color})]},s))})]}),(0,t.jsxs)("div",{className:"choose-size mt-5",children:[(0,t.jsxs)("div",{className:"heading flex items-center justify-between",children:[(0,t.jsxs)("div",{className:"text-title",children:["Size: ",(0,t.jsx)("span",{className:"text-title size",children:q})]}),(0,t.jsx)("div",{className:"caption1 size-guide text-red underline cursor-pointer",onClick:()=>{S(!0)},children:"Size Guide"}),(0,t.jsx)(C.Z,{data:z,isOpen:P,onClose:()=>{S(!1)}})]}),(0,t.jsx)("div",{className:"list-size flex items-center gap-2 flex-wrap mt-3",children:null==z?void 0:z.sizes.map((e,s)=>(0,t.jsx)("div",{className:"size-item ".concat("freesize"===e?"px-3 py-2":"w-12 h-12"," flex items-center justify-center text-button rounded-full bg-white border border-line ").concat(q===e?"active":""),onClick:()=>B(e),children:e},s))})]}),(0,t.jsx)("div",{className:"text-title mt-5",children:"Quantity:"}),(0,t.jsxs)("div",{className:"choose-quantity flex items-center max-xl:flex-wrap lg:justify-between gap-5 mt-3",children:[(0,t.jsxs)("div",{className:"quantity-block md:p-3 max-md:py-1.5 max-md:px-3 flex items-center justify-between rounded-lg border border-line sm:w-[180px] w-[120px] flex-shrink-0",children:[(0,t.jsx)(d.W,{onClick:()=>{z&&z.quantityPurchase>1&&(z.quantityPurchase-=1,D(z.id,z.quantityPurchase-1,q,M))},className:"".concat((null==z?void 0:z.quantityPurchase)===1?"disabled":""," cursor-pointer body1")}),(0,t.jsx)("div",{className:"body1 font-semibold",children:null==z?void 0:z.quantityPurchase}),(0,t.jsx)(o.v,{onClick:()=>{z&&(z.quantityPurchase+=1,D(z.id,z.quantityPurchase+1,q,M))},className:"cursor-pointer body1"})]}),(0,t.jsx)("div",{onClick:()=>{z&&($.cartArray.find(e=>e.id===z.id)||L({...z}),D(z.id,z.quantityPurchase,q,M),E(),A())},className:"button-main w-full text-center bg-white text-black border border-black",children:"Add To Cart"})]}),(0,t.jsx)("div",{className:"button-block mt-5",children:(0,t.jsx)("div",{className:"button-main w-full text-center",children:"Buy It Now"})}),(0,t.jsxs)("div",{className:"flex items-center flex-wrap lg:gap-20 gap-8 gap-y-4 mt-5",children:[(0,t.jsxs)("div",{className:"compare flex items-center gap-3 cursor-pointer",onClick:()=>{z&&(R.compareArray.length<3?R.compareArray.some(e=>e.id===z.id)?O(z.id):Z(z):alert("Compare up to 3 products")),U()},children:[(0,t.jsx)("div",{className:"compare-btn md:w-12 md:h-12 w-10 h-10 flex items-center justify-center border border-line cursor-pointer rounded-xl duration-300 hover:bg-black hover:text-white",children:(0,t.jsx)(x.d,{className:"heading6"})}),(0,t.jsx)("span",{children:"Compare"})]}),(0,t.jsxs)("div",{className:"share flex items-center gap-3 cursor-pointer",children:[(0,t.jsx)("div",{className:"share-btn md:w-12 md:h-12 w-10 h-10 flex items-center justify-center border border-line cursor-pointer rounded-xl duration-300 hover:bg-black hover:text-white",children:(0,t.jsx)(m.L,{weight:"fill",className:"heading6"})}),(0,t.jsx)("span",{children:"Share Products"})]})]}),(0,t.jsxs)("div",{className:"more-infor mt-6",children:[(0,t.jsxs)("div",{className:"flex items-center gap-4 flex-wrap",children:[(0,t.jsxs)("div",{className:"flex items-center gap-1",children:[(0,t.jsx)(h._,{className:"body1"}),(0,t.jsx)("div",{className:"text-title",children:"Delivery & Return"})]}),(0,t.jsxs)("div",{className:"flex items-center gap-1",children:[(0,t.jsx)(p.H,{className:"body1"}),(0,t.jsx)("div",{className:"text-title",children:"Ask A Question"})]})]}),(0,t.jsxs)("div",{className:"flex items-center flex-wrap gap-1 mt-3",children:[(0,t.jsx)(u.B,{className:"body1"}),(0,t.jsx)("span",{className:"text-title",children:"Estimated Delivery:"}),(0,t.jsx)("span",{className:"text-secondary",children:"14 January - 18 January"})]}),(0,t.jsxs)("div",{className:"flex items-center flex-wrap gap-1 mt-3",children:[(0,t.jsx)(j.b,{className:"body1"}),(0,t.jsx)("span",{className:"text-title",children:"38"}),(0,t.jsx)("span",{className:"text-secondary",children:"people viewing this product right now!"})]}),(0,t.jsxs)("div",{className:"flex items-center gap-1 mt-3",children:[(0,t.jsx)("div",{className:"text-title",children:"SKU:"}),(0,t.jsx)("div",{className:"text-secondary",children:"53453412"})]}),(0,t.jsxs)("div",{className:"flex items-center gap-1 mt-3",children:[(0,t.jsx)("div",{className:"text-title",children:"Categories:"}),(0,t.jsxs)("div",{className:"text-secondary",children:[null==z?void 0:z.category,", ",null==z?void 0:z.gender]})]}),(0,t.jsxs)("div",{className:"flex items-center gap-1 mt-3",children:[(0,t.jsx)("div",{className:"text-title",children:"Tag:"}),(0,t.jsx)("div",{className:"text-secondary",children:null==z?void 0:z.type})]})]}),(0,t.jsx)("div",{className:"list-payment mt-7",children:(0,t.jsxs)("div",{className:"main-content lg:pt-8 pt-6 lg:pb-6 pb-4 sm:px-4 px-3 border border-line rounded-xl relative max-md:w-2/3 max-sm:w-full",children:[(0,t.jsx)("div",{className:"heading6 px-5 bg-white absolute -top-[14px] left-1/2 -translate-x-1/2 whitespace-nowrap",children:"Guranteed safe checkout"}),(0,t.jsxs)("div",{className:"list grid grid-cols-6",children:[(0,t.jsx)("div",{className:"item flex items-center justify-center lg:px-3 px-1",children:(0,t.jsx)(a(),{src:"/images/payment/Frame-0.png",width:500,height:450,alt:"payment",className:"w-full"})}),(0,t.jsx)("div",{className:"item flex items-center justify-center lg:px-3 px-1",children:(0,t.jsx)(a(),{src:"/images/payment/Frame-1.png",width:500,height:450,alt:"payment",className:"w-full"})}),(0,t.jsx)("div",{className:"item flex items-center justify-center lg:px-3 px-1",children:(0,t.jsx)(a(),{src:"/images/payment/Frame-2.png",width:500,height:450,alt:"payment",className:"w-full"})}),(0,t.jsx)("div",{className:"item flex items-center justify-center lg:px-3 px-1",children:(0,t.jsx)(a(),{src:"/images/payment/Frame-3.png",width:500,height:450,alt:"payment",className:"w-full"})}),(0,t.jsx)("div",{className:"item flex items-center justify-center lg:px-3 px-1",children:(0,t.jsx)(a(),{src:"/images/payment/Frame-4.png",width:500,height:450,alt:"payment",className:"w-full"})}),(0,t.jsx)("div",{className:"item flex items-center justify-center lg:px-3 px-1",children:(0,t.jsx)(a(),{src:"/images/payment/Frame-5.png",width:500,height:450,alt:"payment",className:"w-full"})})]})]})})]})]})]})]})})})})}},37389:function(e,s,i){"use strict";i.r(s);var t=i(57437),l=i(2265),r=i(24033),a=i(93523),c=i(25153),n=i(5963),d=i(41629);s.default=()=>{let{isModalOpen:e,closeModalSearch:s}=(0,d.useModalSearchContext)(),[i,o]=(0,l.useState)(""),x=(0,r.useRouter)(),m=e=>{x.push("/search-result?query=".concat(e)),s(),o("")};return(0,t.jsx)(t.Fragment,{children:(0,t.jsx)("div",{className:"modal-search-block",onClick:s,children:(0,t.jsxs)("div",{className:"modal-search-main md:p-10 p-6 rounded-[32px] ".concat(e?"open":""),onClick:e=>{e.stopPropagation()},children:[(0,t.jsxs)("div",{className:"form-search relative",children:[(0,t.jsx)(a.Y,{className:"absolute heading5 right-6 top-1/2 -translate-y-1/2 cursor-pointer",onClick:()=>{m(i)}}),(0,t.jsx)("input",{type:"text",placeholder:"Searching...",className:"text-button-lg h-14 rounded-2xl border border-line w-full pl-6 pr-12",value:i,onChange:e=>o(e.target.value),onKeyDown:e=>"Enter"===e.key&&m(i)})]}),(0,t.jsxs)("div",{className:"keyword mt-8",children:[(0,t.jsx)("div",{className:"heading5",children:"Feature keywords Today"}),(0,t.jsxs)("div",{className:"list-keyword flex items-center flex-wrap gap-3 mt-4",children:[(0,t.jsx)("div",{className:"item px-4 py-1.5 border border-line rounded-full cursor-pointer duration-300 hover:bg-black hover:text-white",onClick:()=>m("dress"),children:"Dress"}),(0,t.jsx)("div",{className:"item px-4 py-1.5 border border-line rounded-full cursor-pointer duration-300 hover:bg-black hover:text-white",onClick:()=>m("t-shirt"),children:"T-shirt"}),(0,t.jsx)("div",{className:"item px-4 py-1.5 border border-line rounded-full cursor-pointer duration-300 hover:bg-black hover:text-white",onClick:()=>m("underwear"),children:"Underwear"}),(0,t.jsx)("div",{className:"item px-4 py-1.5 border border-line rounded-full cursor-pointer duration-300 hover:bg-black hover:text-white",onClick:()=>m("top"),children:"Top"})]})]}),(0,t.jsxs)("div",{className:"list-recent mt-8",children:[(0,t.jsx)("div",{className:"heading6",children:"Recently viewed products"}),(0,t.jsx)("div",{className:"list-product pb-5 hide-product-sold grid xl:grid-cols-4 sm:grid-cols-2 gap-7 mt-4",children:c.slice(0,4).map(e=>(0,t.jsx)(n.default,{data:e,type:"grid",style:"style-1"},e.id))})]})]})})})}},33458:function(e,s,i){"use strict";var t=i(57437),l=i(2265),r=i(40589),a=i(61705);i(12353),s.Z=e=>{let{data:s,isOpen:i,onClose:c}=e,[n,d]=(0,l.useState)(""),[o,x]=(0,l.useState)({min:100,max:200}),[m,h]=(0,l.useState)({min:30,max:90}),p=(e,s)=>{e>180||s>70?d("2XL"):e>170||s>60?d("XL"):e>160||s>50?d("L"):e>155||s>45?d("M"):e>150||s>40?d("S"):d("XS")};return(0,t.jsx)(t.Fragment,{children:(0,t.jsx)("div",{className:"modal-sizeguide-block",onClick:c,children:(0,t.jsxs)("div",{className:"modal-sizeguide-main md:p-10 p-6 rounded-[32px] ".concat(i?"open":""),onClick:e=>{e.stopPropagation()},children:[(0,t.jsx)("div",{className:"close-btn absolute right-5 top-5 w-6 h-6 rounded-full bg-surface flex items-center justify-center duration-300 cursor-pointer hover:bg-black hover:text-white",onClick:c,children:(0,t.jsx)(r.X,{size:14})}),(0,t.jsx)("div",{className:"heading3",children:"Size guide"}),(0,t.jsxs)("div",{className:"md:mt-8 mt-6 progress",children:[(0,t.jsxs)("div",{className:"flex imd:items-center gap-10 justify-between max-md:flex-col gap-y-5 max-md:pr-3",children:[(0,t.jsxs)("div",{className:"flex items-center flex-shrink-0 gap-8",children:[(0,t.jsx)("span",{className:"flex-shrink-0 md:w-14",children:"Height"}),(0,t.jsxs)("div",{className:"flex items-center justify-center w-20 gap-1 py-2 border border-line rounded-lg flex-shrink-0",children:[(0,t.jsx)("span",{children:o.max}),(0,t.jsx)("span",{className:"caption1 text-secondary",children:"Cm"})]})]}),(0,t.jsx)(a.Z,{range:!0,defaultValue:[100,200],min:100,max:200,onChange:e=>{Array.isArray(e)&&x({min:e[0],max:e[1]}),p(o.max,m.max)}})]}),(0,t.jsxs)("div",{className:"flex md:items-center gap-10 justify-between max-md:flex-col gap-y-5 max-md:pr-3 mt-5",children:[(0,t.jsxs)("div",{className:"flex items-center gap-8 flex-shrink-0",children:[(0,t.jsx)("span",{className:"flex-shrink-0 md:w-14",children:"Weight"}),(0,t.jsxs)("div",{className:"flex items-center justify-center w-20 gap-1 py-2 border border-line rounded-lg flex-shrink-0",children:[(0,t.jsx)("span",{children:m.max}),(0,t.jsx)("span",{className:"caption1 text-secondary",children:"Kg"})]})]}),(0,t.jsx)(a.Z,{range:!0,defaultValue:[30,90],min:30,max:90,onChange:e=>{Array.isArray(e)&&h({min:e[0],max:e[1]}),p(o.max,m.max)}})]})]}),(0,t.jsx)("div",{className:"heading6 mt-8",children:"suggests for you:"}),(0,t.jsx)("div",{className:"list-size flex items-center gap-2 flex-wrap mt-3",children:null==s?void 0:s.sizes.map((e,s)=>(0,t.jsx)("div",{className:"size-item w-12 h-12 flex items-center justify-center text-button rounded-full bg-white border border-line ".concat(n===e?"active":""),children:e},s))}),(0,t.jsxs)("table",{children:[(0,t.jsx)("thead",{children:(0,t.jsxs)("tr",{children:[(0,t.jsx)("th",{children:"Size"}),(0,t.jsx)("th",{children:"Bust"}),(0,t.jsx)("th",{children:"Waist"}),(0,t.jsx)("th",{children:"Low Hip"})]})}),(0,t.jsxs)("tbody",{children:[(0,t.jsxs)("tr",{children:[(0,t.jsx)("td",{children:"XS"}),(0,t.jsx)("td",{children:"32"}),(0,t.jsx)("td",{children:"24-25"}),(0,t.jsx)("td",{children:"33-34"})]}),(0,t.jsxs)("tr",{children:[(0,t.jsx)("td",{children:"S"}),(0,t.jsx)("td",{children:"34-35"}),(0,t.jsx)("td",{children:"26-27"}),(0,t.jsx)("td",{children:"35-36"})]}),(0,t.jsxs)("tr",{children:[(0,t.jsx)("td",{children:"M"}),(0,t.jsx)("td",{children:"36-37"}),(0,t.jsx)("td",{children:"28-29"}),(0,t.jsx)("td",{children:"38-40"})]}),(0,t.jsxs)("tr",{children:[(0,t.jsx)("td",{children:"L"}),(0,t.jsx)("td",{children:"38-39"}),(0,t.jsx)("td",{children:"30-31"}),(0,t.jsx)("td",{children:"42-44"})]}),(0,t.jsxs)("tr",{children:[(0,t.jsx)("td",{children:"XL"}),(0,t.jsx)("td",{children:"40-41"}),(0,t.jsx)("td",{children:"32-33"}),(0,t.jsx)("td",{children:"45-47"})]}),(0,t.jsxs)("tr",{children:[(0,t.jsx)("td",{children:"2XL"}),(0,t.jsx)("td",{children:"42-43"}),(0,t.jsx)("td",{children:"34-35"}),(0,t.jsx)("td",{children:"48-50"})]})]})]})]})})})}},66106:function(e,s,i){"use strict";i.r(s);var t=i(57437);i(2265);var l=i(61396),r=i.n(l),a=i(16691),c=i.n(a),n=i(40589),d=i(78363),o=i(55811);s.default=()=>{let{isModalOpen:e,closeModalWishlist:s}=(0,d.useModalWishlistContext)(),{wishlistState:i,removeFromWishlist:l}=(0,o.useWishlist)();return(0,t.jsx)(t.Fragment,{children:(0,t.jsx)("div",{className:"modal-wishlist-block",onClick:s,children:(0,t.jsxs)("div",{className:"modal-wishlist-main py-6 ".concat(e?"open":""),onClick:e=>{e.stopPropagation()},children:[(0,t.jsxs)("div",{className:"heading px-6 pb-3 flex items-center justify-between relative",children:[(0,t.jsx)("div",{className:"heading5",children:"Wishlist"}),(0,t.jsx)("div",{className:"close-btn absolute right-6 top-0 w-6 h-6 rounded-full bg-surface flex items-center justify-center duration-300 cursor-pointer hover:bg-black hover:text-white",onClick:s,children:(0,t.jsx)(n.X,{size:14})})]}),(0,t.jsx)("div",{className:"list-product px-6",children:i.wishlistArray.map(e=>(0,t.jsxs)("div",{className:"item py-5 flex items-center justify-between gap-3 border-b border-line",children:[(0,t.jsxs)("div",{className:"infor flex items-center gap-5",children:[(0,t.jsx)("div",{className:"bg-img",children:(0,t.jsx)(c(),{src:e.images[0],width:300,height:300,alt:e.name,className:"w-[100px] aspect-square flex-shrink-0 rounded-lg"})}),(0,t.jsxs)("div",{className:"",children:[(0,t.jsx)("div",{className:"name text-button",children:e.name}),(0,t.jsxs)("div",{className:"flex items-center gap-2 mt-2",children:[(0,t.jsxs)("div",{className:"product-price text-title",children:["$",e.price,".00"]}),(0,t.jsx)("div",{className:"product-origin-price text-title text-secondary2",children:(0,t.jsxs)("del",{children:["$",e.originPrice,".00"]})})]})]})]}),(0,t.jsx)("div",{className:"remove-wishlist-btn caption1 font-semibold text-red underline cursor-pointer",onClick:()=>l(e.id),children:"Remove"})]},e.id))}),(0,t.jsxs)("div",{className:"footer-modal p-6 border-t bg-white border-line absolute bottom-0 left-0 w-full text-center",children:[(0,t.jsx)(r(),{href:"/wishlist",onClick:s,className:"button-main w-full text-center uppercase",children:"View All Wish List"}),(0,t.jsx)("div",{onClick:s,className:"text-button-uppercase mt-4 text-center has-line-before cursor-pointer inline-block",children:"Or continue shopping"})]})]})})})}},41629:function(e,s,i){"use strict";i.r(s),i.d(s,{ModalSearchProvider:function(){return c},useModalSearchContext:function(){return a}});var t=i(57437),l=i(2265);let r=(0,l.createContext)(void 0),a=()=>{let e=(0,l.useContext)(r);if(!e)throw Error("useModalSearchContext must be used within a ModalSearchProvider");return e},c=e=>{let{children:s}=e,[i,a]=(0,l.useState)(!1);return(0,t.jsx)(r.Provider,{value:{isModalOpen:i,openModalSearch:()=>{a(!0)},closeModalSearch:()=>{a(!1)}},children:s})}},81461:function(e,s,i){"use strict";i.d(s,{m:function(){return t}});let t=()=>{let e=new Date("2024-10-28"),s=new Date,i=e.getTime()-s.getTime();return i>0?{days:Math.floor(i/864e5),hours:Math.floor(i%864e5/36e5),minutes:Math.floor(i%36e5/6e4),seconds:Math.floor(i%6e4/1e3)}:{days:0,hours:0,minutes:0,seconds:0}}},72061:function(){}},function(e){e.O(0,[4096,6691,4523,601,4408,7847,2971,2472,1744],function(){return e(e.s=4737)}),_N_E=e.O()}]);
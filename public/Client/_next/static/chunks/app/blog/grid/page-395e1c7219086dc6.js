(self.webpackChunk_N_E=self.webpackChunk_N_E||[]).push([[4735],{48948:function(e,a,t){Promise.resolve().then(t.bind(t,53058))},53058:function(e,a,t){"use strict";t.r(a);var s=t(57437),n=t(2265),l=t(36520),i=t(34836),r=t(90618),c=t(29701),d=t(14798),o=t(51896),g=t(25986),u=t(24033);a.default=()=>{let[e,a]=(0,n.useState)(0),t=9*e;(0,u.useRouter)();let m=c.filter(e=>"underwear"!==e.category);0===m.length&&(m=[{id:"no-data",category:"no-data",tag:"no-data",title:"no-data",date:"no-data",author:"no-data",avatar:"no-data",thumbImg:"",coverImg:"",subImg:["",""],shortDesc:"no-data",description:"no-data",slug:"no-data"}]);let h=Math.ceil(m.length/9);0===h&&a(0);let x=m.slice(t,t+9);return(0,s.jsxs)(s.Fragment,{children:[(0,s.jsx)(l.default,{props:"style-one bg-black",slogan:"New customers save 10% with the code GET10"}),(0,s.jsxs)("div",{id:"header",className:"relative w-full",children:[(0,s.jsx)(i.default,{props:"bg-transparent"}),(0,s.jsx)(r.Z,{heading:"Blog Grid",subHeading:"Blog Grid"})]}),(0,s.jsx)("div",{className:"blog grid md:py-20 py-10",children:(0,s.jsxs)("div",{className:"container",children:[(0,s.jsx)("div",{className:"list-blog grid lg:grid-cols-3 sm:grid-cols-2 md:gap-[42px] gap-8",children:x.map(e=>(0,s.jsx)(d.default,{data:e,type:"style-one"},e.id))}),h>1&&(0,s.jsx)("div",{className:"list-pagination w-full flex items-center justify-center md:mt-10 mt-6",children:(0,s.jsx)(g.Z,{pageCount:h,onPageChange:e=>{a(e)}})})]})}),(0,s.jsx)(o.Z,{})]})}},90618:function(e,a,t){"use strict";var s=t(57437);t(2265);var n=t(61396),l=t.n(n),i=t(39267);a.Z=e=>{let{heading:a,subHeading:t}=e;return(0,s.jsx)(s.Fragment,{children:(0,s.jsx)("div",{className:"breadcrumb-block style-shared",children:(0,s.jsx)("div",{className:"breadcrumb-main bg-linear overflow-hidden",children:(0,s.jsx)("div",{className:"container lg:pt-[134px] pt-24 pb-10 relative",children:(0,s.jsx)("div",{className:"main-content w-full h-full flex flex-col items-center justify-center relative z-[1]",children:(0,s.jsxs)("div",{className:"text-content",children:[(0,s.jsx)("div",{className:"heading2 text-center",children:a}),(0,s.jsxs)("div",{className:"link flex items-center justify-center gap-1 caption1 mt-3",children:[(0,s.jsx)(l(),{href:"/",children:"Homepage"}),(0,s.jsx)(i.T,{size:14,className:"text-secondary2"}),(0,s.jsx)("div",{className:"text-secondary2 capitalize",children:t})]})]})})})})})})}},25986:function(e,a,t){"use strict";var s=t(57437);t(2265);var n=t(99641),l=t.n(n);a.Z=e=>{let{pageCount:a,onPageChange:t}=e;return(0,s.jsx)(l(),{previousLabel:"<",nextLabel:">",pageCount:a,pageRangeDisplayed:3,marginPagesDisplayed:2,onPageChange:e=>t(e.selected),containerClassName:"pagination",activeClassName:"active"})}}},function(e){e.O(0,[4096,6691,4523,5407,7847,3039,1896,2308,2971,2472,1744],function(){return e(e.s=48948)}),_N_E=e.O()}]);
<template>
  <div class="vh-100 bg-light pt-3 pt-lg-5 px-3">
    <div class="container-lg">
      <div class="row mb-4 text-center">
        <h1>✨ Flexbox Playground ✨</h1>
      </div>
      <div class="row h-100 bg-body shadow-lg rounded-4 overflow-x-hidden">
        <div class="col-12 col-md-3 full-height">
          <h3 class="sticky-top bg-body p-2 border-bottom border-light-subtle">
            ⚙ Flex Properties
          </h3>
          <div class="card mb-3 border-0" v-for="(values, prop) in flexProps" :key="prop">
            <h5 class="card-header border-0">{{ prop }}:</h5>
            <ul class="list-group list-group-horizontal overflow-x-auto p-2 text-center fw-medium">
              <li v-for="value in values" :key="value"
                class="list-group-item list-group-item-action list-group-item-light border-0 rounded shadow-sm mx-1 hstack justify-content-center w-auto"
                :class="{ 'active': isActive(prop, value) }" @click="setProp(prop, value)" role="button" tabindex="0">
                {{ value }}
              </li>
            </ul>
          </div>
        </div>
        <div class="col-12 col-md-5 shadow-sm vstack pb-3 full-height">
          <h3 class="sticky-top bg-body p-2 border-bottom border-light-subtle hstack flex-wrap gap-2">
            <span>🔲 Flex Container</span>
            <button class="btn btn-dark btn-sm ms-auto fw-medium text-nowrap" type="button" @click="showCode = !showCode">
              {{ showCode ? 'Hide ' : 'Show' }} code
            </button>
          </h3>
          <div class="bg-light-subtle rounded-4 flex-grow-1 shadow-sm p-2" :style="flexContainerStyle">
            <div :style="flexItemStyle">
              <h6>Flex item one</h6>
              <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
            <div :style="flexItemStyle">
              <h6>Flex item two</h6>
              <p class="text-muted">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Porro, recusandae!</p>
            </div>
            <div :style="flexItemStyle">
              <h6>Flex item three</h6>
              <p class="text-muted">Lorem ipsum dolor sit amet.</p>
            </div>
            <div :style="flexItemStyle">
              <h6>Flex item four</h6>
              <p class="text-muted">Lorem ipsum dolor sit amet consectetur.</p>
            </div>
            <div :style="flexItemStyle">
              <h6>Flex item five</h6>
              <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-3 vstack full-height" v-if="showCode">
          <h3 class="sticky-top bg-body p-2 border-bottom border-light-subtle hstack flex-wrap gap-2">
            <span>📝 Css code</span>
            <button class="btn btn-dark btn-sm ms-auto fw-medium" type="button" @click="copyCodeToClipboard">
              {{ isCopied ? 'Copied' : 'Copy' }}
            </button>
          </h3>
          <pre class="bg-light-subtle text-light-emphasis rounded-4 flex-grow-1 shadow-sm p-2"
            id="cssRules">{{ cssRules }}</pre>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      flexProps: {
        'flex-direction': ['row', 'row-reverse', 'column', 'column-reverse'],
        'flex-wrap': ['nowrap', 'wrap', 'wrap-reverse'],
        'justify-content': ['flex-start', 'flex-end', 'center', 'space-between', 'space-around', 'space-evenly'],
        'align-items': ['flex-start', 'flex-end', 'center', 'baseline', 'stretch'],
        'align-content': ['flex-start', 'flex-end', 'center', 'space-between', 'space-around', 'stretch'],
      },
      selectedFlexProps: {
        'flex-direction': 'row',
        'flex-wrap': 'nowrap',
        'justify-content': '',
        'align-items': '',
        'align-content': '',
      },
      flexContainerStyle: {
        'display': 'flex',
        'gap': '5px',
      },
      flexItemStyle: {
        'max-width': '150px',
        'background': 'rgba(232, 232, 232, 0.75)',
        'border-radius': '16px',
        'padding': '5px',
        'text-align': 'center',
        'word-wrap': 'break-word'
      },
      cssRules: '',
      showCode: false,
      isCopied: false,
    };
  },
  mounted() {
    document.title = "ДЗ 20. Базові концепції Vue";
    document.head.insertAdjacentHTML(
      "beforeend",
      '<link  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">'
    );
    this.generateCssRules();
  },
  methods: {
    isActive(prop, value) {
      return this.selectedFlexProps[prop] === value;
    },
    setProp(prop, value) {
      this.selectedFlexProps[prop] = value;
      this.generateCssRules();
    },
    generateCssRules() {
      let notEmptyProps = [];
      for (const key in this.selectedFlexProps) {
        if (this.selectedFlexProps[key]) {
          notEmptyProps[key] = this.selectedFlexProps[key];
        }
      }
      this.flexContainerStyle = {
        ...this.flexContainerStyle,
        ...notEmptyProps,
      };
      const flexContainerCss = this.formatStyle(this.flexContainerStyle, '.flex-container');
      const flexItemCss = this.formatStyle(this.flexItemStyle, '.flex-item');
      this.cssRules = `${flexContainerCss}\n\n${flexItemCss}`;
    },
    formatStyle(style, selector) {
      let styleString = `${selector} {\n`;
      for (const key in style) {
        styleString += `  ${key}: ${style[key]};\n`;
      }
      styleString += '}';
      return styleString;
    },
    copyCodeToClipboard() {
      const cssRules = document.getElementById('cssRules');
      navigator.clipboard.writeText(cssRules.innerText.trim())
        .then(() => {
          this.isCopied = true;
          setTimeout(() => this.isCopied = false, 2000);
        })
        .catch(err => console.error('Failed to copy: ', err));
    },
  },
};
</script>

<style>
.container-lg {
  height: 70dvh;

  @media (max-width: 768px) {
    height: 80dvh;
  }
}

.full-height {
  height: 100%;
  overflow-y: scroll;

  @media (max-width: 768px) {
    height: 80%;
  }
}
</style>

<template>
  <aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
      <ul data-widget="tree" class="sidebar-menu tree">
        <li class="header">MAIN NAVIGATION</li>
        <router-link tag="li" :to="{name: 'form'}" class>
          <a>
            <i class="fa fa-th"></i>
            <span>新規登録</span>
          </a>
        </router-link>
        <router-link tag="li" :to="{name: 'setting'}" class>
          <a>
            <i class="fa fa-th"></i>
            <span>項目登録</span>
          </a>
        </router-link>
        <router-link
          tag="li"
          :to="{name: 'list'}"
          class="router-link-exact-active router-link-active"
        >
          <a>
            <i class="fa fa-th"></i>
            <span>見積一覧</span>
          </a>
        </router-link>
        <li class>
          <a>
            <i class="fa fa-th"></i>
            <span>受注一覧</span>
          </a>
        </li>
        <li class>
          <a>
            <i class="fa fa-th"></i>
            <span>案件管理</span>
          </a>
        </li>
        <li class>
          <a>
            <i class="fa fa-th"></i>
            <span>メンテナンス</span>
          </a>
        </li>
      </ul>
    </section>
  </aside>
</template>

<script>
export default {
  name: "Aside"
};
</script>

<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import FlashMessages from '@/components/FlashMessages.vue';
import { home } from '@/routes';
import { dashboard, logout } from '@/routes/admin';

const page = usePage();

const admin = computed(() => page.props.auth.admin);
</script>

<template>
    <div class="flex min-h-screen flex-col bg-cream-dark">
        <header class="bg-bark text-cream">
            <div
                class="mx-auto flex w-full max-w-6xl flex-wrap items-center justify-between gap-4 px-6 py-5"
            >
                <Link
                    :href="dashboard()"
                    class="font-display text-xl font-bold"
                >
                    Administration
                </Link>

                <nav class="flex flex-wrap items-center gap-5 text-sm">
                    <Link
                        :href="home()"
                        class="underline-offset-4 hover:underline"
                    >
                        Voir le site
                    </Link>
                    <span v-if="admin" class="text-cream/70">{{
                        admin.login
                    }}</span>
                    <Link
                        :href="logout()"
                        method="post"
                        as="button"
                        class="cursor-pointer underline-offset-4 hover:underline"
                    >
                        Déconnexion
                    </Link>
                </nav>
            </div>
        </header>

        <FlashMessages />

        <main class="mx-auto w-full max-w-6xl grow px-6 py-10">
            <slot />
        </main>
    </div>
</template>

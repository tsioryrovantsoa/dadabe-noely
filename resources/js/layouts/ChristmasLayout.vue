<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import FlashMessages from '@/components/FlashMessages.vue';
import { home, login, logout, register } from '@/routes';
import { index as giftsIndex } from '@/routes/gifts';
import { index as wishesIndex } from '@/routes/wishes';

const page = usePage();

const child = computed(() => page.props.auth.child);
</script>

<template>
    <div class="flex min-h-screen flex-col">
        <header class="bg-pine text-cream">
            <div
                class="mx-auto flex w-full max-w-6xl flex-wrap items-center justify-between gap-4 px-6 py-5"
            >
                <Link :href="home()" class="font-display text-2xl font-bold">
                    Dadabe Noely
                </Link>

                <nav class="flex flex-wrap items-center gap-5 text-sm">
                    <Link
                        :href="giftsIndex()"
                        class="underline-offset-4 hover:underline"
                    >
                        Catalogue
                    </Link>

                    <template v-if="child">
                        <Link
                            :href="wishesIndex()"
                            class="underline-offset-4 hover:underline"
                        >
                            Mes souhaits
                        </Link>
                        <span
                            class="rounded-full bg-gold px-4 py-1.5 font-display font-semibold text-bark"
                        >
                            {{ child.available_points }} /
                            {{ child.bonus_points }} pts
                        </span>
                        <Link
                            :href="logout()"
                            method="post"
                            as="button"
                            class="cursor-pointer underline-offset-4 hover:underline"
                        >
                            Déconnexion
                        </Link>
                    </template>

                    <template v-else>
                        <Link
                            :href="login()"
                            class="underline-offset-4 hover:underline"
                        >
                            Connexion
                        </Link>
                        <Link
                            :href="register()"
                            class="rounded-full bg-berry px-4 py-1.5 font-medium hover:bg-berry-light"
                        >
                            Inscription
                        </Link>
                    </template>
                </nav>
            </div>
        </header>

        <FlashMessages />

        <main class="mx-auto w-full max-w-6xl grow px-6 py-10">
            <slot />
        </main>

        <footer class="bg-pine-dark py-6 text-center text-sm text-cream-dark">
            Projet INF102 - ETU1370 - IT University
        </footer>
    </div>
</template>

<div x-data="{
  currentIndex: 0,
  panels: [
    {
      image: '../img/visibility.jpg',
      title: 'Embrace Wellness: Discover Your Mental Health Oasis',
      description: 'Learn more about mental health.',
    },
    {
      image: '../img/gloom1.jpg',
      title: 'Mind Matters: Elevate Your Mental Well-Being Today',
      description: 'Explore resources for well-being.',
    },
    {
      image: '../img/sunflower.jpg',
      title: 'Prioritize Mental Health: Your Journey to Inner Balance',
      description: 'Get support for mental health challenges.',
    },
    {
      image: '../img/help.jpg',
      title: 'Unlocking Happiness: Nurturing Your Mental Health',
      description: 'Access resources for a healthy mind.',
    },
    {
      image: '../img/team.jpg',
      title: 'Mental Health Matters: Join the Conversation for a Better You',
      description: 'Stay connected and informed about mental well-being.',
    },
  ],
  showPanel(index) {
    this.currentIndex = index;
  },
  nextPanel() {
    this.currentIndex = (this.currentIndex + 1) % this.panels.length;
  },
  previousPanel() {
    this.currentIndex = (this.currentIndex - 1 + this.panels.length) % this.panels.length;
  },
}" x-init="() => {
  setInterval(() => {
    $refs.nextButton.click();
  }, 8000);
}">
    <div class="carousel-container p-4 relative">
        <div class="carousel-wrapper flex overflow-x-hidden">
        <template x-for="(panel, index) in panels" :key="index">
            <div class="carousel-panel w-full relative" x-show="currentIndex === index">
                <img :src="panel.image" :alt="'Image ' + (index + 1)">
                <button class="prev-button hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block absolute left-4 top-1/2 transform -translate-y-1/2" @click="previousPanel">Previous</button>
                <button x-ref="nextButton" class="next-button hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block absolute right-4 top-1/2 transform -translate-y-1/2" @click="nextPanel">Next</button>
                <h2 class="text-lg text-center font-semibold mt-2 text-yellow-200" x-text="panel.title"></h2>
                <p class="text-sm text-center mt-2 text-yellow-300" x-text="panel.description"></p>
            </div>
        </template>
        </div>
    </div>
</div>

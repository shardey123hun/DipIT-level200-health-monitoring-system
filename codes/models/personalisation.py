import pandas as pd
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity

# Sample data
content_data = pd.DataFrame({
    'content_id': [1, 2, 3],
    'title': ['Introduction to AI', 'Advanced Machine Learning', 'AI in Healthcare'],
    'content': [
        'AI is the simulation of human intelligence.',
        'Machine learning is a subset of AI that involves...',
        'AI applications in healthcare include diagnostics...'
    ]
})

# TF-IDF Vectorization
tfidf_vectorizer = TfidfVectorizer(stop_words='english')
tfidf_matrix = tfidf_vectorizer.fit_transform(content_data['content'])

# Compute Cosine Similarity
cosine_sim = cosine_similarity(tfidf_matrix, tfidf_matrix)

# Function to get recommendations
def get_recommendations(content_id, cosine_sim=cosine_sim):
    idx = content_data[content_data['content_id'] == content_id].index[0]
    sim_scores = list(enumerate(cosine_sim[idx]))
    sim_scores = sorted(sim_scores, key=lambda x: x[1], reverse=True)
    sim_scores = sim_scores[1:4]  # Get top 3 recommendations
    content_indices = [i[0] for i in sim_scores]
    return content_data['title'].iloc[content_indices]

# Example usage
print(get_recommendations(1))

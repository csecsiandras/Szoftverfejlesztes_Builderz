using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;

public class MenuScript : MonoBehaviour {

	public AudioSource audio;
	
	public void StartGame(string SceneName)
	{
		PlayClickSound();
		SceneManager.LoadScene(SceneName);
	}

	public void RateUs(string url)
	{
		PlayClickSound();
		Application.OpenURL(url);
	}

	public void QuitGame()
	{
		PlayClickSound();
		Application.Quit();
	}
	
	public void PlayClickSound()
	{
		audio.Play();
	}
}
